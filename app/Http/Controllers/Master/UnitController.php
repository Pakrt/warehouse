<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Unit;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;


class UnitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $unit = Unit::orderby('id', 'DESC')->get();

        return view('master.unit.index', compact('unit'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'bail|required|string|unique:units',
            'name' => 'required|string',
        ]);

        $unit = new Unit;
        $unit->fill($request->all());
        $unit->save();

        return Redirect::route('unit.index')
        ->with([
            'status' => 'success',
            'tittle' => 'Success',
            'messages' => 'Membuat data satuan'
        ]);
    }

    public function show(Unit $unit)
    {
        //
    }

    public function edit($id)
    {
        $unit = Unit::find($id);

        return view('master.unit.edit', compact('unit'));
    }

    public function update(Request $request, $id)
    {
        $unit = Unit::find($id);
        $unit->update($request->all());

        return Redirect::route('unit.index')
        ->with([
            'status' => 'success',
            'tittle' => 'Success',
            'messages' => 'Mengubah data satuan'
        ]);
    }

    public function destroy($id)
    {
        Unit::destroy($id);

        return Redirect::route('unit.index')
        ->with([
            'status' => 'success',
            'tittle' => 'Success',
            'messages' => 'Menghapus data satuan'
        ]);
    }
}
