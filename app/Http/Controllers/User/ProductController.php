<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function products($id)
    {
        $subCategories = SubCategory::where('category_id', $id)->get();
        $title = Category::find($id);
        $products = DB::table('products')
                    ->select('products.*', 'sub_categories.sub_category_name')
                    ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
                    ->join('categories', 'sub_categories.category_id', '=', 'categories.id')
                    ->where('sub_categories.category_id', '=', $id)
                    ->where('products.in_stock', '=', 1)
                    ->get();

        return view('user.products')->with([
            'title' => $title->category_name,
            'subCategories' => $subCategories,
            'products' =>   $products
        ]);
    }

    public function productBySubCategoryID($id)
    {
        $products = DB::table('products')
                    ->select('products.*', 'sub_categories.sub_category_name')
                    ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
                    ->where('sub_categories.id', '=', $id)
                    ->where('products.in_stock', '=', 1)
                    ->get();

        return response()->json(['products' => $products]);
    }
}
