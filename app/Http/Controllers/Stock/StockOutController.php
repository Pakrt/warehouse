<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Stock\StockOut;
use App\Models\Stock\StockOutDt;
use Illuminate\Http\Request;

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
        //
    }

    public function store(Request $request)
    {
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
