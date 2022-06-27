<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Master\Item;
use App\Models\Master\Rack;
use App\Models\Master\RackDt;
use App\Models\Master\Supplier;
use App\Models\Stock\Stock;
use App\Models\Stock\StockIn;
use App\Models\Stock\StockInDt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class StockInController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $stockIn = StockIn::with(['supplier', 'stockInDt', 'stockInDt.item'])->orderBy('id', 'desc')->get();

        return view('stock.stockIn.index', compact('stockIn'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $items = Item::all();

        return view('stock.stockIn.create', compact('suppliers', 'items'));
    }

    public function formManual(Request $request)
    {
        // return $request->all();
        $rack = Rack::with('rackDt')->where('area', $request->origin)->get();
        $data = [];
        // for ($i=0; $i < count($request->itemsId); $i++) { 
        //    for ($j=0; $j < $request->itemsRack[$i]; $j++) { 
        //     $data[] = $request->itemsId[$i];
        //    }
        // }
        // return $data;

        // return view('stock.stockIn.chooseRack');
    }

    public function chooseRack(Request $request)
    {
        // return $request->all();
        $suppliers = Supplier::all();
        $items = Item::all();
        $racks = Rack::with('rackDt')->where('area', $request->origin)->get();
        $rackDt = RackDt::with('racks')->where('is_load', '0')->get();
        
        $data = [];
        for ($i=0; $i < count($request->itemsId); $i++) { 
           for ($j=0; $j < $request->itemsRack[$i]; $j++) { 
            $data[] = $request->itemsId[$i];
           }
        }

        return view('stock.stockIn.chooseRack', compact('request', 'suppliers', 'racks', 'rackDt', 'items'));
    }

    public function createAuto()
    {
        $suppliers = Supplier::all();
        $items = Item::all();

        return view('stock.stockIn.createAuto', compact('suppliers', 'items'));
    }

    public function algen(Request $request)
    {
        // return $request->all();
        $id = StockIn::max('id') + 1;
        $itemsId = count($request->itemsId);
        $weight = [];
        $genWeight = [];
        $genRack = [];

        Validator::make($request->all(), [
            'invoice' => ['required', 'unique:stock_in'],
            'date' => ['required', 'date'],
            'supplier_id' => ['required', 'integer'],
        ])->validate();

        // Menentukan jumlah rak yang dibutuhkan / Panjang cromosom
        for ($i=0; $i < $itemsId; $i++) { 
            if ($request->itemsQty[$i]%$request->itemsCapacity[$i] == 0) {
                $rack[$i] = $request->itemsQty[$i] / $request->itemsCapacity[$i];
                // Mendapatkan nilai weight pada tiap item yang dimasukkan ke dalam rak
                for ($j=0; $j <(floor($rack[$i])) ; $j++) { 
                    $weight[$i][$j] = $request->itemsWeight[$i];
                }
            } else {
                $rack[$i] = $request->itemsQty[$i] / $request->itemsCapacity[$i];
                $rack[$i] = floor($rack[$i])+1;
                // Mendapatkan nilai weight pada tiap item yang dimasukkan ke dalam rak
                for ($j=0; $j <((floor($rack[$i])+1)-1) ; $j++) { 
                    $weight[$i][$j] = $request->itemsWeight[$i];
                }
            }
        }

        // Membuat nilai gen Weight menjadi array 1 dimensi
        for ($i=0; $i <count($weight) ; $i++) { 
            for ($j=0; $j <count($weight[$i]) ; $j++) { 
                $genWeight[] = $weight[$i][$j];
            }
        }
        rsort($genWeight);

        // Mencari rak yang tersedia
        $rackDtRaw = RackDt::with('racks')->get();
        for ($i=0; $i <count($rackDtRaw) ; $i++) { 
            if($rackDtRaw[$i]->is_load == 0 && $rackDtRaw[$i]->racks->area == $request->origin && $rackDtRaw[$i]->racks->status == 'on'){
                $genRack[] = $rackDtRaw[$i]->id;
            }
        }

        $cromosomRack = [];
        $cromosomWeight = [];
        // Mendapatkan gen Rak yang sesuai dengan panjang cromosom
        for ($i=0; $i <count($genRack) ; $i++) { 
            if($i < count($genWeight)){
                // Inisiasi cromosom dengan gen Rak dan gen Weight
                $cromosomRack[] = $genRack[$i];
                $cromosomWeight[] = $genWeight[$i];
            }
        }

        return $this->inPopulasi($cromosomRack,$cromosomWeight);
    }

    public function store(Request $request)
    {
        // return $request->all();
        $id = StockIn::max('id')+1;

        StockIn::create([
            'id' => $id,
            'invoice' => $request->invoice,
            'supplier_id' => $request->supplier_id,
            'date' => $request->date,
            'description' => $request->description,
            'created_by' => Auth::user()->id,
        ]);

        $itemId = [];
        $rackId = [];
        for ($i=0; $i < count($request->itemsQty); $i++) {
            StockInDt::create([
                'stock_in_id' => $id,
                'item_id' =>  $request->get('itemsId'.$i)[0],
                'qty' => $request->itemsQty[$i],
                'date' => $request->date,
                'created_by' => Auth::user()->id,    
            ]);
            for ($j=0; $j < count($request->get('rackDt'.$i)); $j++) { 
                if($j === array_key_last($request->get('rackDt'.$i))){
                    $perhitungan[$i][$j] =  $request->itemsQty[$i]%$request->itemsCapacity[$i];
                } else {
                    $perhitungan[$i][$j] = (int)$request->itemsCapacity[$i];
                }
                Stock::create([
                    'item_id' => $request->get('itemsId'.$i)[0],
                    'rack_dt_id' => $request->get('rackDt'.$i)[$j],
                    'qty' => $perhitungan[$i][$j],
                    'description' => $request->description,
                    'exp' => date('Y-m-d'),
                    'date' => $request->date,
                    'clock' => date('h:i:s'),
                    'item_weight' => $request->itemsWeight[$i],
                    'created_by' => Auth::user()->id,
                ]);
                RackDt::where('id', $request->get('rackDt'.$i)[$j])->update([
                    'is_load' => 1,
                    'updated_by' => Auth::user()->id,
                ]);
            }
        }

        return Response::json([
            'status' => 'success',
            'tittle' => 'Success',
            'messages' => 'Membuat data barang masuk'
        ]);
    }

    public function inPopulasi($cromosomRack,$cromosomWeight)
    {        
        $individu = 5;
        // $populationRack = [];
        $populationWeight = [];

        $checkArrayTerkecil = $cromosomRack[0];
        
        for ($i = 0; $i < count($cromosomRack); $i++) { 
            // Membangkitkan populasi sesuai dengan input individu secara random
            for ($j = 0; $j < $individu; $j++) {
                // Mengacak gen yang ada didalam cromosomRack
                // shuffle($cromosomRack);
                // $population[$j][$i] =  [$cromosomRack[$i],$cromosomWeight[$i]];
                // $populationRack[$j][$i] =  $cromosomRack[$i];
                $populationWeight[$j][$i] =  $cromosomWeight[$i];
                // $populationRack = $cromosomRack;

            }
        }

        $array = $cromosomRack;
        $numRandoms = count($cromosomRack);
        $count = count($cromosomRack);
  
        if ($count >= $numRandoms) {
            for ($j = 0; $j < $individu; $j++) {
            $populationRack[$j] = array();

                while (count($populationRack[$j]) < $numRandoms) {
    
                    $random = $cromosomRack[rand(0, $count - 1)];
    
                    if (!in_array($random, $populationRack[$j])) {
                        array_push($populationRack[$j], $random);
                    }
                }
            }
        }
  
        return $this->clash($populationRack,$populationWeight,$checkArrayTerkecil);
    }
    public function clash($populationRack,$populationWeight,$checkArrayTerkecil)
    {
        // $populationRack = [
        //     [
        //       63,
        //       65,
        //       68,
        //       67,
        //       66,
        //       61,
        //       62,
        //       64
        //     ],
        //     [
        //       66,
        //       64,
        //       61,
        //       68,
        //       63,
        //       62,
        //       67,
        //       65
        //     ],
        //     [
        //       62,
        //       66,
        //       64,
        //       65,
        //       67,
        //       61,
        //       63,
        //       68
        //     ]
        //     ];
        
        $arrayRack = [];
        $countClashRack = [];
        $countClashWeight = [];
        $totalRackAtas = 0;

        for ($i=0; $i <count($populationRack) ; $i++) { 
            $findUnique = array_unique($populationRack[$i]);
            $duplicateArray = array_diff_assoc($populationRack[$i],$findUnique);
            $removeSameValue = array_diff($findUnique, $duplicateArray);
            $unique_keys = array_keys($removeSameValue);
            $duplicate_keys = array_keys(array_intersect($populationRack[$i], $duplicateArray));
            $clash = $duplicateArray;
            if($clash != null){
                $countClashRack[$i] = 1;
            }else{
                $countClashRack[$i] = 0;
            }

            for ($j=0; $j <count($populationRack[$i]) ; $j++) { 
                if($populationRack[$i][$j]-6 >= $checkArrayTerkecil){
                    // $dt[$i][$j]['rackAtas'] = $populationRack[$i][$j] . ' Lebih besar ';
                    $arrayRack[$i][$j]['atas'] = $populationRack[$i][$j]-6;
                    $totalRackAtas+=1;
                    // array_values($arrayRackAtas);
                }else{
                    // $dt[$i][$j]['checkBawah'] = $populationRack[$i][$j] . ' - ' . $populationRack[$i][$j];
                    $arrayRack[$i][$j]['bawah'] = $populationRack[$i][$j];
                }
                // $totalRack = array_sum($arrayRack[$i][$j]['atas']);
            }
        }
        if($totalRackAtas > 0){
        
            $keyFind = [];

            for ($i=0; $i <count($arrayRack) ; $i++) {
                for ($j=0; $j <count($arrayRack[$i]) ; $j++) { 
                    if(isset($arrayRack[$i][$j]['atas'])){
                        $keyFind[$i][] = [array_search($arrayRack[$i][$j]['atas'], $populationRack[$i]),$arrayRack[$i][$j]['atas']+6,$populationWeight[$i][$j]];
                        // $keyFind[$i][]['index'] = array_search($arrayRack[$i][$j]['atas'], $populationRack[$i]);
                        // $keyFind[$i][]['rack'] = $arrayRack[$i][$j]['atas']+6;
                        // $keyFind[$i][]['weight'] = $populationWeight[$i][$j];
                    }
                    // $keyFind[] =  array_search($arrayRackAtas[$i][$j], $populationWeight[$i]);
                }
            }

            $getWeight = [];
            for ($i=0; $i <count($populationWeight) ; $i++) { 
                for ($j=0; $j <count($populationWeight[$i]) ; $j++) { 
                    if(isset($keyFind[$i][$j][0])){
                        // $getWeight[$i][] = $populationWeight[$i][$keyFind[$i][$j][0]];
                        $getWeight[$i][] = [$populationWeight[$i][$keyFind[$i][$j][0]],$populationRack[$i][$keyFind[$i][$j][0]]];
                        
                        
                    }
                }
            }
            
            $data = [];
            for ($i=0; $i <count($getWeight) ; $i++) {
                for ($j=0; $j <count($getWeight[$i])  ; $j++) { 
                    if($getWeight[$i][$j][0] < $keyFind[$i][$j][2] ){
                        $data[$i][] = 'Clash';
                    }else{  
                        $data[$i][] = 'Aman';
                    }
                }
                if($data[$i][0] == 'Aman' && $data[$i][1] == 'Aman' ){
                    $data[$i] = '0';
                }else{
                    $data[$i] = '1';
                }
            }
            return [$data,$countClashRack];

        } else {
            return [$countClashRack,$countClashRack];
            
        }
    }
    public function fitness($population)
    {
        // return $population;

    }

}
