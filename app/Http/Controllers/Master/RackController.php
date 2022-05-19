<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Rack;
use Illuminate\Http\Request;

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
        //
    }

    public function show(Rack $rack)
    {
        //
    }

    public function edit(Rack $rack)
    {
        //
    }

    public function update(Request $request, Rack $rack)
    {
        //
    }

    public function destroy(Rack $rack)
    {
        //
    }
}
