<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductCategoryController extends Controller
{
    // private $modelproduct;

    // public function __construct(ProductCategory $productModel)
    // {
    //     $this->modelproduct = $productModel;
    // }
    public function index()
    {
        // ------------------------dung ELOQUENT------------------------
        // $productCategories=  ProductCategory::all();
        $productCategories = ProductCategory::orderByDesc('id')->get();

        return view('admin.pages.productCategory.listPdCt', compact('productCategories'));
        
    }

    public function store(Request $request)
    {

        // ------------------------dung ELOQUENT------------------------
        $request->validate(['name' => 'required|max:255']);
        $productCategory = ProductCategory::create(['name' => $request->name]);
        //  or
        // $productCategory = ProductCategory::insert(['name' => $request->name]);
        // $productCategory = new ProductCategory;
        // $productCategory->name = $request->name;
        // $productCategory->save();
        // $productCategory = ProductCategory::where(['name', 'like', '%d%'])->get();
        // $productCategory = ProductCategory::orderBy('id')->get();



        return redirect()->route('product-category.index');
    }


    public function create()
    {
        return view('admin.pages.productCategory.product_category');
        
    }

    public function show(string $id)
    {
    

    }

    public function edit(string $id)
    {
        // $productCategory= DB::table('product_category')
        // ->where('id',$id )
        // ->get();
        $productCategory = ProductCategory::find($id);
        return view('admin.pages.productCategory.detailPdCt',compact('productCategory'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate(["name"=>"required|max:255"]);

        $productCategory = ProductCategory::find($id);
        $productCategory->update(['name' => $request->name]);

        // return $this->index();
        return redirect()->route('product-category.index')->with('message', 'Update Successfully!');

    }

    public function destroy(string $id)
    {
        $productCategory = ProductCategory::find($id);
        // $productCategory->delete();
        $productCategory->forceDelete();

        return redirect()->route('product-category.index');
    }
}
