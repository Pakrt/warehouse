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
use App\Models\Stock\StockOut;
use App\Models\Stock\StockOutDt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
class StockOutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $stockOut = StockOut::get();

        return view('stock.stockOut.index', compact('stockOut'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $items = Item::all();
        $rackDt = RackDt::with('racks')->get();

        return view('stock.stockOut.create', compact('suppliers', 'items','rackDt'));
    }

    public function store(Request $req)
    {
        return $req->all();
        $id = StockIn::max('id')+1;

        StockOut::create([
            'id' => $id,
            'invoice' => $request->invoice,
            'supplier_id' => $request->supplier_id,
            'date' => $request->date,
            'clock' => date('h:i:s'),
            'product_origin' => $request->origin,
            'description' => $request->description,
            'created_by' => Auth::user()->id,
        ]);

        $itemId = [];
        $rackId = [];
        for ($i=0; $i < count($request->itemsQty); $i++) {
            StockOutDt::create([
                'stock_in_id' => $id,
                'item_id' =>  $request->get('itemsId'.$i)[0],
                // 'qty' => $request->itemsQty[$i],
                'date' => $request->date,
                'production_date' => date('Y-m-d'),
                'expired_date' => date('Y-m-d'),
                'created_by' => Auth::user()->id,    
            ]);

            Item::where('id', $request->get('itemsId'.$i)[0])->update([
                'qty' => $request->itemsQty[$i],
            ]);

            for ($j=0; $j < count($request->get('rackDt'.$i)); $j++) {
                if($j === array_key_last($request->get('rackDt'.$i))){
                    if ($request->itemsQty[$i]%$request->itemsCapacity[$i] == 0) {
                        $perhitungan[$i][$j] = (int)$request->itemsCapacity[$i];
                    } else {
                        $perhitungan[$i][$j] =  $request->itemsQty[$i]%$request->itemsCapacity[$i];
                    }
                } else {
                    $perhitungan[$i][$j] = (int)$request->itemsCapacity[$i];
                }
                Stock::create([
                    'item_id' => $request->get('itemsId'.$i)[0],
                    'rack_dt_id' => $request->get('rackDt'.$i)[$j],
                    'item_qty' => $perhitungan[$i][$j],
                    'description' => $request->description,
                    'expired_date' => date('Y-m-d'),
                    'production_date' => date('Y-m-d'),
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

        //
    }

    public function show(StockOut $stockOut)
    {
        //
    }

    public function edit(StockOut $stockOut)
    {
        //
    }

    public function update(Request $req, StockOut $stockOut)
    {
        //
    }

    public function destroy(StockOut $stockOut)
    {
        //
    }
}
