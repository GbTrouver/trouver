<?php

namespace App\Http\Controllers\Admin\Salons;

use Auth;
use App\User;
use App\Salon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalonsController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.salons.index');
    }

    public function create(Request $request)
    {
        return view('admin.salons.create');
    }
}
