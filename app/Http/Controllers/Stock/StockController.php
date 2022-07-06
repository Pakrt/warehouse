<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Master\Item;
use App\Models\Master\Rack;
use App\Models\Master\RackDt;
use App\Models\Stock\Stock;
use App\Models\Stock\StockIn;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $rack = Rack::with('rackDt')->get();
        $rack2 = Rack::with('rackDt', 'rackDt.stock')->get();
        $stock = Stock::with('rackDt')->get();
        $rackDt = RackDt::with('stock')
        ->leftJoin('stocks', 'rack_dt.id', '=', 'stocks.rack_dt_id')
        ->leftJoin('items', 'items.id', '=', 'stocks.item_id')
        ->orderBy('rack_dt.id', 'desc')
        ->get();
        $item = Item::with('stock')->get();
        // return $item;
        $stock = Stock::with('rackDt','item')
        // ->leftJoin('rack_dt', 'stocks.id', '=', 'rack_dt.id')
        // ->leftJoin('items', 'items.id', '=', 'stocks.item_id')
        // ->orderBy('rack_dt.id', 'desc')
        ->get();
        // return $stock;
        
        return view('stock.stock.index', compact('item', 'rack', 'rack2', 'rackDt', 'stock'));
    }

    public function stockRacks()
    {
        $rack = Rack::with('rackDt')->get();
        $rack2 = Rack::with('rackDt', 'rackDt.stock')->get();
        $stock = Stock::with('rackDt')->get();
        $rackDt = RackDt::with('stock')->select('rack_dt.id','stocks.item_id','rack_dt.rack_id','rack_dt.number','rack_dt.is_load','stocks.item_qty','items.code')
        ->leftJoin('stocks', 'rack_dt.id', '=', 'stocks.rack_dt_id')
        ->leftJoin('items', 'items.id', '=', 'stocks.item_id')
        ->orderBy('rack_dt.id', 'desc')
        ->get();
        // return $rackDt;
        
        return view('stock.stock.indexRack', compact('rack', 'rack2', 'rackDt', 'stock'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Stock $stock)
    {
        //
    }

    public function edit(Stock $stock)
    {
        //
    }

    public function update(Request $request, Stock $stock)
    {
        //
    }

    public function destroy(Stock $stock)
    {
        //
    }
}
