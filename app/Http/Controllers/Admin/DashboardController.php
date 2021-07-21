<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $data['title'] = "Admin Dashboard";
        $data['transactions'] = DB::table('coinpayment_transactions')->get();
        return view('admin.dashboard', compact('data'));
    }
}
