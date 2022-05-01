<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Distributor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class DistributorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function code($type)
    {
        $index = Distributor::max('id')+1;
        $index = str_pad($index, 3, '0', STR_PAD_LEFT);

        return $code = $type . $index;
    }

    public function index()
    {
        $code = $this->code('DS');
        $distributor = Distributor::orderBy('id', 'DESC')->get();

        return view('master.distributor.index', compact('distributor', 'code'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'bail|required|string|unique:distributors',
            'name' => 'required|string',
            'phone' => 'required|string|max:14',
        ]);

        $distributor = new Distributor;
        $distributor->fill($request->all());
        $distributor->save();

        return Redirect::route('distributor.index')
        ->with([
            'status' => 'success',
            'tittle' => 'Success',
            'messages' => 'Membuat data distributor'
        ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $distributor = Distributor::find($id);

        return view('master.distributor.edit', compact('distributor'));
    }

    public function update(Request $request, $id)
    {
        $distributor = Distributor::find($id);
        $distributor->update($request->all());

        return Redirect::route('distributor.index')
        ->with([
            'status' => 'success',
            'tittle' => 'Success',
            'messages' => 'Mengubah data distributor'
        ]);
    }

    public function destroy($id)
    {
        Distributor::destroy($id);

        return Redirect::route('distributor.index')
        ->with([
            'status' => 'success',
            'tittle' => 'Success',
            'messages' => 'Menghapus data distributor'
        ]);
    }
}
