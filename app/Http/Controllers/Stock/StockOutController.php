<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Master\Item;
use App\Models\Master\Rack;
use App\Models\Master\RackDt;
use App\Models\Master\Distributor;
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
        $stockOut = StockOut::with('stockOutDt')->get();

        return view('stock.stockOut.index', compact('stockOut'));
    }

    public function create()
    {
        $distributors = Distributor::get();
        $items = Item::all();
        $rackDt = RackDt::with('racks','stock')->where('is_load','1')->get();

        return view('stock.stockOut.create', compact('distributors', 'items','rackDt'));
    }

    public function stockRackCheck(Request $request)
    {
        # code...
        $data = Stock::with('rackDt','rackDt.racks')->where('item_id',$request->id)->where('product_origin',$request->origin)->get();

        return Response::json([
            'data'=>$data
        ]);
        // return $request->all();
    }
    public function store(Request $request)
    {
        // return $request->all();
        $id = StockOut::max('id')+1;

        StockOut::create([
            'id' => $id,
            'invoice' => $request->invoice,
            'distributor_id' => $request->distributor_id,
            'date' => $request->date,
            'clock' => date('h:i:s'),
            'product_origin' => $request->origin,
            'description' => $request->description,
            'created_by' => Auth::user()->id,
        ]);

        $itemId = [];
        $rackId = [];
        for ($i=0; $i < count($request->itemsId); $i++) {
            $dt = StockOutDt::max('id')+1;
            StockOutDt::create([
                'id'=>$dt,
                'stock_out_id' => $id,
                'item_id' =>  $request->get('itemsId')[$i],
                'qty' => $request->itemsQty[$i],
                'date' => $request->date,
                'production_date' => date('Y-m-d'),
                'expired_date' => date('Y-m-d'),
                'created_by' => Auth::user()->id,    
            ]);
            Stock::where('rack_dt_id',$request->get('rackDtId'.($i+1))[0])->where('item_id',$request->get('itemsId')[$i])->delete();
            // for ($j=0; $j < count($request->get('rackDtId'.($i+1))); $j++) {

            //     StockOutRackDt::create([
            //         'stock_out_dt_id'=>$request->get('rackDtId'.($i+1))[$j],
            //         'rack_dt_id'=>$dt,
            //     ]);
            RackDt::where('id', $request->get('rackDtId'.($i+1))[0])->update([
                'is_load' => 0,
                'updated_by' => Auth::user()->id,
            ]);
               
            //     // $gg = $
            // }
        }

        return Response::json([
            'status' => 'success',
            'tittle' => 'Success',
            'messages' => 'Membuat data barang keluar'
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

    public function update(Request $request, StockOut $stockOut)
    {
        //
    }

    public function destroy(StockOut $stockOut)
    {
        //
    }
}
