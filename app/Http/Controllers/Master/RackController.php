<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Rack;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class RackController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $rack = Rack::orderby('name', 'ASC')->get();

        return view('master.rack.index', compact('rack'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:racks',
            'row' => 'required|integer|max:100',
        ]);

        $rack = new Rack;
        $rack->fill($request->all());
        $rack->save();

        return Redirect::route('rack.index')
        ->with([
            'status' => 'success',
            'tittle' => 'Success',
            'messages' => 'Membuat data rak penyimpanan'
        ]);
    }

    public function show(Rack $rack)
    {
        //
    }

    public function edit($id)
    {
        $rack = Rack::find($id);

        return view('master.rack.edit', compact('rack'));
    }

    public function update(Request $request, $id)
    {
        if ($request->status != "on") {
            $status = "off";
        } else {
            $status = "on";
        }
        $rack = Rack::find($id);
        $rack->update([
            'name' => $request->name,
            'area' => $request->area,   
            'row' => $request->row,   
            'status' => $status,
            'updated_by' => $request->updated_by,
        ]);
        
        return Redirect::route('rack.index')
        ->with([
            'status' => 'success',
            'tittle' => 'Success',
            'messages' => 'Mengubah data rak penyimpanan'
        ]);
    }

    public function destroy($id)
    {
        Rack::destroy($id);

        return Redirect::route('rack.index')
        ->with([
            'status' => 'success',
            'tittle' => 'Success',
            'messages' => 'Menghapus data rak penyimpanan'
        ]);
    }
}
