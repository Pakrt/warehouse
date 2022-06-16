<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Master\Item;
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
        $id = StockIn::max('id') + 1;
        $itemsId = count($request->itemsId);

        Validator::make($request->all(), [
            'invoice' => ['required', 'unique:stock_in'],
            'date' => ['required', 'date'],
            'supplier_id' => ['required', 'integer'],
        ])->validate();

        StockIn::create([
            'invoice' => $request->invoice,
            'supplier_id' => $request->supplier_id,
            'date' => $request->date,
            'description' => $request->description,
            'created_by' => Auth::user()->id,
        ]);

        for ($i=0; $i < $itemsId; $i++) {
            StockInDt::create([
                'stock_in_id' => $id,
                'item_id' => $request->itemsId[$i],
                'qty' => $request->itemsQty[$i],
                'date' => $request->date,
                'created_by' => Auth::user()->id,
            ]);
        }

        // $div = itemQty / itemCapacity
        // $div = 1000 / 55
        // $div = 18 (koma diabaikan) sisa 10
        // $mod = 1000 % 55
        // $mod = 10

        return Redirect::route('stockIn.index')
        ->with([
            'status' => 'success',
            'tittle' => 'Success',
            'messages' => 'Membuat data barang masuk'
        ]);
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
