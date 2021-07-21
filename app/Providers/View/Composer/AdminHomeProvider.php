<?php

namespace App\Providers\View\Composer;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use App\Models\TicketReply;

class AdminHomeProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('admin.partials.top_widgets', function($view){
            $countUsers = DB::table('users')->count();
            $countProducts = DB::table('products')->count();
            $totalWallets = DB::table('coinpayment_transactions')->where('status', '>=', 100)->get();
            $totalAmount = null;
            foreach($totalWallets as $key=>$value) {
                $totalAmount += $value->amount_total_fiat;
            }
            $countTickets = DB::table('tickets')->count();
            $view->with([
                'countUsers' => $countUsers,
                'countProducts' => $countProducts,
                'totalWallets' => $totalAmount ? $totalAmount : 0,
                'countTickets' => $countTickets
                ]);
        });

        View::composer('admin.layouts.sidebar', function($view){
            $mainCategories = DB::table('categories')->get();
            $view->with(['mainCategories' => $mainCategories]);
        });

        View::composer('admin.layouts.header', function($view){
            $notifications = Ticket::all();
            $view->with(['ticketNotifications' => $notifications]);
        });

        View::composer('user.layouts.header', function($view){
            $ticketReplies = TicketReply::where('user_id', Auth::user()->id)->count();
            $view->with(['ticketReplies' => $ticketReplies]);
        });
    }
}
