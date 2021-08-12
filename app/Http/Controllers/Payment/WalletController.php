<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Payment\CoinbaseGateway;
use Hexters\CoinPayment\CoinPayment;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Payment;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\User;

class WalletController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addMoney()
    {
        $title = 'Add Money';
        $payment_history = DB::table('coinpayment_transactions')
        ->where('buyer_email', Auth::user()->email)
        ->get();
        return view('user.add-money')->with(['title' => $title, 'payment_history' => $payment_history]);
    }

    public function deposit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'deposit' => 'required'
        ]);
        if($validator->fails())
        {
            return back()->withErrors($validator->errors());
        }

        $transaction['order_id'] = uniqid();
        $transaction['amountTotal'] = (FLOAT) $request->deposit;
        $transaction['note'] = config('app.name') . ' Wallet Funding';
        $transaction['buyer_name'] = Auth::user()->username;
        $transaction['buyer_email'] = Auth::user()->email;
        $transaction['redirect_url'] = route('deposit.complete');
        $transaction['cancel_url'] = route('deposit.cancel');

        $transaction['items'][] = [
            'itemDescription' => config('app.name').' Wallet Funding',
            'itemPrice' => (FLOAT) $request->deposit,
            'itemQty' => (INT) 1,
            'itemSubtotalAmount' => (FLOAT) $request->deposit
        ];

        $payment_link = CoinPayment::generatelink($transaction);

        return redirect($payment_link);

        // $createCharge = new CoinbaseGateway;
        // $storeCharge = $createCharge->createCharges([
        //     "name" => "Skull-Net Wallet Depositor",
        //     "description" => 'SkullNet Funding Wallet',
        //     "pricing_type" => "fixed_price",
        //     "local_price" => [
        //         "amount" => $request->deposit,
        //         "currency" => "USD",
        //     ],
        //     "metadata" => [
        //         "customer_id" => Auth::user()->id,
        //         "customer_name" => Auth::user()->email
        //     ],
        //     "redirect_url" => route('deposit.complete'),
        //     "cancel_url" => route('deposit.cancel')
        // ]);

        // $payment = new Payment;
        // $payment->customer_id = intval($storeCharge['data']['metadata']['customer_id']);
        // $payment->customer_name = $storeCharge['data']['metadata']['customer_name'];
        // $payment->address = $storeCharge['data']['addresses']['bitcoin'];
        // $payment->code = $storeCharge['data']['code'];
        // $payment->transaction_id = $storeCharge['data']['id'];
        // $payment->local_amount = floatval($storeCharge['data']['pricing']['local']['amount']);
        // $payment->local_currency = $storeCharge['data']['pricing']['local']['currency'];
        // $payment->bitcoin_amount = floatval($storeCharge['data']['pricing']['bitcoin']['amount']);
        // $payment->bitcoin_currency = $storeCharge['data']['pricing']['bitcoin']['currency'];
        // $payment->save();

        // return redirect($storeCharge['data']['hosted_url']);

    }

    public function depositComplete()
    {
        $title = "Deposit Completed";
        return view('user.deposit-completed', compact('title'));
    }

    public function depositCancel()
    {
        $title = "Deposit Canceled";
        return view('user.deposit-canceled', compact('title'));
    }

    public function cartPage()
    {
        $title = "Order Items";
        $orderItems = DB::table('order_items')
                        ->select('order_items.id', 'sub_categories.sub_category_name AS product_type',
                        'products.name','products.price')
                        ->join('products', 'order_items.product_id', '=', 'products.id')
                        ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
                        ->join('users', 'order_items.user_id', '=', 'users.id')
                        ->where('users.id', '=', Auth::user()->id)
                        ->get();
        $totalPrice = null;
        foreach($orderItems as $item)
        {
            $totalPrice += $item->price;
        }
        return view('user.cart')->with([
            'title' => $title,
            'orderItems' => $orderItems,
            'totalPrice' => $totalPrice
            ]);
    }

    public function cart($id)
    {
        $product = Product::find($id);
        $cart = new OrderItem();
        $cart->user_id = Auth::user()->id;
        $cart->product_id = $product->id;
        $cart->price = floatval($product->price);
        $cart->save();

        $product->in_stock = 0;
        $product->save();

        return response()->json(['success' => "Item Added to Cart"]);
    }

    public function countOrderItems()
    {
        $countOrderItems = OrderItem::where('user_id', '=', Auth::user()->id)->count();
        return response()->json(['countOrderItems' => $countOrderItems]);
    }

    public function deleteOrderItem($id)
    {
        $orderItem = OrderItem::where('id', '=', $id)
                                ->where('user_id', '=', Auth::user()->id)
                                ->first();
        $orderItem->delete();
        $product = Product::find($orderItem->product_id);
        $product->in_stock = 1;
        $product->save();
        return response()->json(['status' => 200]);
    }

    public function processOrder()
    {
        $totalOrderAmount = null;
        $orderItems = OrderItem::where('user_id', Auth::user()->id)->get();

        if(count($orderItems) <= 0)
        {
            return response()->json(['empty_cart' =>  "You dont have item(s) in cart"]);
        }

        foreach($orderItems as $item)
        {
            $totalOrderAmount += $item->price;
        }

        if(Auth::user()->wallet < $totalOrderAmount){
            return response()->json(['error' => "You don't have enough funds in your wallet"]);
        }else{
            foreach($orderItems as $item)
            {
                $product = Product::find($item->product_id);
                $purchase = new Purchase();
                $purchase->user_id = $item->user_id;
                $purchase->sub_category_id = $product->sub_category_id;
                $purchase->order_id = $this->randomStringGenerator();
                $purchase->name = $product->name;
                $purchase->description = $product->description;
                $purchase->price = $product->price;
                $purchase->save();
                $product->delete();
            }

            $user = User::find(Auth::user()->id);
            $user->wallet = ($user->wallet - $totalOrderAmount);
            $user->save();
            OrderItem::where('user_id', Auth::user()->id)->delete();
            return response()->json(['success' => 'Purchase Complate - Thank you!']);
        }
    }

    public function thankYou()
    {
        $title = "Purchase Complete, Thank You!";
        return view('user.thank-you', compact('title'));
    }


    //************** RANDOM STRING GENERATOR ************* */
    protected function randomStringGenerator($length = 6)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomStr = '';
        for($i = 0; $i < $length; $i++)
        {
            $randomStr .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomStr;
    }

}
