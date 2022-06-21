<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Master\Item;
use App\Models\Master\Rack;
use App\Models\Master\RackDt;
use App\Models\Master\Supplier;
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

    public function store(Request $request)
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

        // Mencari rak yang tersedia
        $rackDtRaw = RackDt::with('racks')->get();
        for ($i=0; $i <count($rackDtRaw) ; $i++) { 
            if($rackDtRaw[$i]->is_load == 0 && $rackDtRaw[$i]->racks->area == $request->origin && $rackDtRaw[$i]->racks->status == 'on'){
                $genRack[] = $rackDtRaw[$i]->id;
            }
        }

        $cromosom = [];
        // Mendapatkan gen Rak yang sesuai dengan panjang cromosom
        for ($i=0; $i <count($genRack) ; $i++) { 
            if($i < count($genWeight)){
                // Inisiasi cromosom dengan gen Rak dan gen Weight
                $cromosom[] = [$genRack[$i],$genWeight[$i]];
            }
        }

        return $this->inPopulasi($cromosom);
        
        // StockIn::create([
        //     'invoice' => $request->invoice,
        //     'supplier_id' => $request->supplier_id,
        //     'date' => $request->date,
        //     'description' => $request->description,
        //     'created_by' => Auth::user()->id,
        // ]);

        // for ($i=0; $i < $itemsId; $i++) {
        //     StockInDt::create([
        //         'stock_in_id' => $id,
        //         'item_id' => $request->itemsId[$i],
        //         'qty' => $request->itemsQty[$i],
        //         'date' => $request->date,
        //         'created_by' => Auth::user()->id,
        //     ]);
        // }

        // return Response::json([
        //     'status' => 'success',
        //     'tittle' => 'Success',
        //     'messages' => 'Membuat data barang masuk'
        // ]);
    }

    public function inPopulasi($cromosom)
    {        
        // Mengacak gen yang ada didalam cromosom
        $cromosomRandomArray = [];
        for ($i = 0; $i < count($cromosom); $i++) { 
            for ($j = 0; $j < 5; $j++) {
                shuffle($cromosom);
                $cromosomRandomArray[$j][$i] =  [$cromosom[$i][0],$cromosom[$i][1]];
            }
        }

        return $cromosomRandomArray;

        $var = [];
        $section = array_rand($cromosom,4);
        $individu = 5;
        $random_keys=[];

        return $section;

        // Membangkitkan populasi sesuai dengan input individu secara random
        for ($i=0; $i <$individu ; $i++) { 
            $random_keys[] = array_rand($cromosom,count($cromosom));
        }

        return $random_keys;
    }

    public function show(StockIn $stockIn)
    {
        //
    }

    public function edit(StockIn $stockIn)
    {
        //
    }

    public function update(Request $request, StockIn $stockIn)
    {
        //
    }

    public function destroy(StockIn $stockIn)
    {
        //
    }
}
