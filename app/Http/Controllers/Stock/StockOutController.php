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
        // return $req->all();
        
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
