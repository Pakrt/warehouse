<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function code($type)
    {
        $index = Supplier::max('id')+1;
        $index = str_pad($index, 3, '0', STR_PAD_LEFT);

        return $code = $type . $index;
    }

    public function index()
    {
        $code = $this->code('SP');
        $supplier = Supplier::orderBy('id', 'DESC')->get();

        return view('master.supplier.index', compact('supplier', 'code'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'bail|required|string|unique:suppliers',
            'name' => 'required|string',
            'phone' => 'required|string|max:14',
        ]);

        $supplier = new Supplier;
        $supplier->fill($request->all());
        $supplier->save();

        return Redirect::route('supplier.index')
        ->with([
            'status' => 'success',
            'tittle' => 'Success',
            'messages' => 'Membuat data supplier'
        ]);
    }

    public function show(Supplier $supplier)
    {
        //
    }

    public function edit($id)
    {
        $supplier = Supplier::find($id);

        return view('master.supplier.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::find($id);
        $supplier->update($request->all());

        return Redirect::route('supplier.index')
        ->with([
            'status' => 'success',
            'tittle' => 'Success',
            'messages' => 'Mengubah data supplier'
        ]);
    }

    public function destroy($id)
    {
        Supplier::destroy($id);

        return Redirect::route('supplier.index')
        ->with([
            'status' => 'success',
            'tittle' => 'Success',
            'messages' => 'Menghapus data supplier'
        ]);
    }
}
