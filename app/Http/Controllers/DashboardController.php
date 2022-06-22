<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master\Item;
use App\Models\Master\Rack;
use App\Models\Master\RackDt;
use App\Models\User;
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
        $user = User::get();
        $item = Item::get();
        $rack = Rack::with('rackDt')->where('status', 'on')->get();
        $rackDt = RackDt::get();
        $sumItem = count($item);
        $sumRack = count($rack);
        $sumUser = count($user);
        // return $rackDt;

        return view('dashboard', compact('rack', 'rackDt', 'sumItem', 'sumRack', 'sumUser'));
    }
}
