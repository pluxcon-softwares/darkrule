<?php

namespace App\Providers\View\Composer;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\MessageBoard;
use App\Models\AboutUs;
use Illuminate\Support\Facades\DB;

class UserHomeProvider extends ServiceProvider
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
        View::composer('user.home', function($view){
            $message_boards = MessageBoard::select('id','title', 'created_at', 'admin_id')->where('is_published', 1)->get();
            $about_us = AboutUs::find(1);
            $view->with([
                'message_boards' => $message_boards,
                'about_us'      =>  $about_us
                ]);
        });

        View::composer('user.layouts.top_widgets', function($view){
            $countAccounts = DB::table('products')
                            ->select('products.*')
                            ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
                            ->join('categories', 'sub_categories.category_id', '=', 'categories.id')
                            ->where('categories.category_name', '=', 'accounts')
                            ->orWhere('categories.category_name', '=', 'account')
                            ->where('products.in_stock', '=', 1)
                            ->count();

            $countTools = DB::table('products')
                            ->select('products.*')
                            ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
                            ->join('categories', 'sub_categories.category_id', '=', 'categories.id')
                            ->where('categories.category_name', '=', 'tools')
                            ->orWhere('categories.category_name', '=', 'tool')
                            ->where('products.in_stock', '=', 1)
                            ->count();

            $countTutorials = DB::table('products')
                                ->select('products.*')
                                ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
                                ->join('categories', 'sub_categories.category_id', '=', 'categories.id')
                                ->where('categories.category_name', '=', 'tutorials')
                                ->orWhere('categories.category_name', '=', 'tutorial')
                                ->where('products.in_stock', '=', 1)
                                ->count();

            $countBanklogs = DB::table('products')
                                ->select('products.*')
                                ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
                                ->join('categories', 'sub_categories.category_id', '=', 'categories.id')
                                ->where('categories.category_name', '=', 'bank logs')
                                ->orWhere('categories.category_name', '=', 'bank log')
                                ->orWhere('categories.category_name', '=', 'bank cheques')
                                ->orWhere('categories.category_name', '=', 'bank checks')
                                ->orWhere('categories.category_name', '=', 'bank check')
                                ->where('products.in_stock', '=', 1)
                                ->count();
            $view->with([
                'countAccounts' => $countAccounts,
                'countTools'    => $countTools,
                'countTutorials' => $countTutorials,
                'countBankLogs'     =>  $countBanklogs
                ]);
        });

        View::composer('user.layouts.header', function($view){
            $mainCategories = DB::table('categories')->get();
            $view->with(['mainCategories' => $mainCategories]);
        });
    }
}
