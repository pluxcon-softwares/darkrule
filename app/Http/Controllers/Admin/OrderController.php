<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Payment;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $title = "All Orders";
        return view('admin.orders')->with(['title' => $title]);
    }

    public function getAllOrders()
    {
        $orders = DB::table('coinpayment_transactions')
        ->select('order_id', 'buyer_name', 'amount_total_fiat', 'amountf', 'status')
        ->get();

        return response()->json(['orders' => $orders]);
    }

    public function getOrderProfit()
    {
        $orders = DB::table('coinpayment_transactions')
                    ->select('amount_total_fiat')
                    ->where('status', '>=', 100)
                    ->get();

        $profits = null;
        foreach($orders as $order){
            $profits = ($profits + $order->amount_total_fiat);
        }

        return response()->json(['profits' => $profits]);
    }
}
