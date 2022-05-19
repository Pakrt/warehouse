<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Category;
use App\Models\Master\Item;
use App\Models\Master\Unit;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $category = Category::orderby('code', 'ASC')->get();
        $item = Item::with('category', 'unit')->orderby('id', 'DESC')->get();
        $unit = Unit::orderby('code', 'ASC')->get();

        return view('master.item.index', compact('category', 'item', 'unit'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'bail|required|string|unique:items',
            'name' => 'required|string',
        ]);

        $item = new Item;
        $item->fill($request->all());
        $item->save();

        return Redirect::route('item.index')
        ->with([
            'status' => 'success',
            'tittle' => 'Success',
            'messages' => 'Membuat data barang'
        ]);
    }

    public function show(Item $item)
    {
        //
    }

    public function edit($id)
    {
        $category = Category::orderby('code', 'ASC')->get();
        $item = Item::find($id);
        $unit = Unit::orderby('code', 'ASC')->get();

        return view('master.item.edit', compact('category', 'item', 'unit'));
    }

    public function update(Request $request, $id)
    {
        $item = Item::find($id);
        $item->update($request->all());

        return Redirect::route('item.index')
        ->with([
            'status' => 'success',
            'tittle' => 'Success',
            'messages' => 'Mengubah data barang'
        ]);
    }

    public function destroy($id)
    {
        Item::destroy($id);

        return Redirect::route('item.index')
        ->with([
            'status' => 'success',
            'tittle' => 'Success',
            'messages' => 'Menghapus data barang'
        ]);
    }
}
