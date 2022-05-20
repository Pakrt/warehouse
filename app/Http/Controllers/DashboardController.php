<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master\Item;
use App\Models\Master\Rack;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $item = Item::get();
        $sumItem = count($item);
        $rack = Rack::where('status', 'on')->get();
        $sumRack = count($rack);

        return view('dashboard', compact('sumItem', 'rack', 'sumRack'));
    }
}
