<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $title ="Product Category/Sub-Categories";
        $categories = Category::all();
        return view('admin.subcategories')->with(['title' => $title, 'categories' => $categories]);
    }

    public function categories()
    {
        $categories = Category::all();
        $title = "Main Categories";
        return view('admin.categories')->with(['title' => $title, 'categories' => $categories]);
    }

    public function storeCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()]);
        }

        Category::create($request->all());

        return response()->json(['success' => 'Category has been created']);
    }

    public function editCategory($id)
    {
        $category = Category::find($id);
        return response()->json(['category' => $category]);
    }

    public function updateCategory(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category_name' =>  'required'
        ]);

        if($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()]);
        }

        $category = Category::find($id);
        $category->category_name = $request->category_name;
        $category->save();

        return response()->json(['success' => 'Category updated!']);
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        $category->delete();
        return response()->json(['success' => 'Category has been deleted!']);
    }

    public function subCategories()
    {
        $sub_categories = DB::table('sub_categories')
                            ->select('sub_categories.*', 'categories.category_name')
                            ->join('categories', 'sub_categories.category_id', '=' , 'categories.id')
                            ->get();
        return response()->json(['subCategories' => $sub_categories]);
    }

    public function subCategoriesByID($id)
    {
        $subCategory = DB::table('sub_categories')
                            ->select('sub_categories.*', 'categories.category_name')
                            ->join('categories', 'sub_categories.category_id', '=' , 'categories.id')
                            ->where('sub_categories.category_id', '=', $id)
                            ->get();
        return response()->json(['subCategory' => $subCategory]);
    }

    public function addSubCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id'   =>  'required',
            'sub_category_name' =>  'required'
        ]);

        if($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()]);
        }

        $subCategory = new SubCategory();
        $subCategory->category_id = $request->category_id;
        $subCategory->sub_category_name = $request->sub_category_name;
        $subCategory->save();

        return response()->json(['success' => 'Sub-Category created successfully!']);
    }

    public function editSubCategory($id)
    {
        $subCategory = SubCategory::find($id);
        $categories = Category::all();
        return response()->json(['subCategory' => $subCategory, 'categories' => $categories]);
    }

    public function updateSubCategory(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category_id'   =>  'required',
            'sub_category_name' =>  'required'
        ]);

        if($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()]);
        }

        $subCategory = SubCategory::find($id);
        $subCategory->category_id = $request->category_id;
        $subCategory->sub_category_name = $request->sub_category_name;
        $subCategory->save();

        return response()->json(['success' => 'Sub Category updated!']);
    }

    public function deleteSubCategory($id)
    {
        $subCategory = SubCategory::find($id);
        $subCategory->delete();
        return response()->json(['success' => 'Sub Category deleted!']);
    }
}
