<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index($id)
    {
        $subCategories = SubCategory::where('category_id', $id)->get();
        $title = Category::find($id);
        $products = DB::table('products')
                        ->select('products.*', 'sub_categories.sub_category_name AS type')
                        ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
                        ->join('categories', 'sub_categories.category_id', '=', 'categories.id')
                        ->where('categories.id', '=', $id)
                        ->get();

        return view('admin.products')->with([
            'subCategories' => $subCategories,
            'products'  =>  $products,
            'title' => $title->category_name
        ]);
    }

    public function fetchProductBySubCategory($id)
    {
        $products = DB::table('products')
                    ->select('products.*', 'sub_categories.sub_category_name AS type')
                    ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
                    ->where('sub_categories.id', '=', $id)
                    ->get();

        return response()->json(['products' => $products]);
    }

    public function viewProduct($id)
    {
        $product = DB::table('products')
                    ->select('products.*', 'sub_categories.sub_category_name AS type')
                    ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
                    ->where('products.id', '=', $id)
                    ->first();
        return response()->json(['product' => $product]);
    }

    public function storeProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sub_category_id'   =>  'required',
            'name'  =>  'required',
            'description'   =>  'required',
            'price' =>  'required'
        ]);

        if($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()]);
        }

        $product = new Product();
        $product->sub_category_id = $request->sub_category_id;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->in_stock = $request->in_stock;
        $product->country = $request->country;
        $product->save();

        return response()->json(['success'  =>  'Product created successfully!']);
    }

    public function editProduct($product_id)
    {
        $product = Product::find($product_id);
        return response()->json(['product' => $product]);
    }

    public function updateProduct(Request $request, $product_id)
    {
        $validator = Validator::make($request->all(), [
            'sub_category_id'   =>  'required',
            'name'  =>  'required',
            'description'   =>  'required',
            'price' =>  'required'
        ]);

        if($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()]);
        }

        $product = Product::find($product_id);
        $product->sub_category_id = $request->sub_category_id;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->in_stock = $request->in_stock;
        $product->country = $request->country;
        $product->save();

        return response()->json(['success'  =>  'Product updated successfully!']);
    }

    public function deleteProduct($product_id)
    {
        $product = Product::find($product_id);
        $product->delete();
        return response()->json(['success' => 'Product deleted succesufully!']);
    }
}
