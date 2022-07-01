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
use App\Models\Stock\StockOutRackDt;
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
        // return count($req->get('rackDtId'.'0'));
        // return $req->all();
        $id = StockOut::max('id')+1;

        StockOut::create([
            'id' => $id,
            'invoice' => $req->invoice,
            'supplier_id' => $req->supplier_id,
            'date' => $req->date,
            'clock' => date('h:i:s'),
            'product_origin' => $req->origin,
            'description' => $req->description,
            'created_by' => Auth::user()->id,
        ]);

        $itemId = [];
        $rackId = [];
        for ($i=0; $i < count($req->itemsId); $i++) {
            $dt = StockOutDt::max('id')+1;
            StockOutDt::create([
                'id'=>$dt,
                'stock_out_id' => $id,
                'item_id' =>  $req->get('itemsId')[$i],
                // 'qty' => $req->itemsQty[$i],
                'date' => $req->date,
                'production_date' => date('Y-m-d'),
                'expired_date' => date('Y-m-d'),
                'created_by' => Auth::user()->id,    
            ]);

            for ($j=0; $j < count($req->get('rackDtId'.($i+1))); $j++) {

                StockOutRackDt::create([
                    'stock_out_dt_id'=>$req->get('rackDtId'.($i+1))[$j],
                    'rack_dt_id'=>$dt,
                ]);
                RackDt::where('id', $req->get('rackDtId'.($i+1))[$j])->update([
                    'is_load' => 0,
                    'updated_by' => Auth::user()->id,
                ]);
                Stock::where('rack_dt_id',$req->get('rackDtId'.($i+1))[$j])->delete();
                // $gg = $
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
