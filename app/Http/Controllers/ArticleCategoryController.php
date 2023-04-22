<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class ArticleCategoryController extends Controller
{
    public function index()
    {
        // ------------------------dung ELOQUENT------------------------
        // $productCategories=  ProductCategory::all();
        $articleCategories = ArticleCategory::orderByDesc('id')->get();

        return view('admin.pages.articleCategory.list', compact('articleCategories'));
        
    }

    public function store(Request $request)
    {

        // ------------------------dung ELOQUENT------------------------
        $request->validate(['name' => 'required|max:255']);
        $articleCategory = ArticleCategory::create(['name' => $request->name]);
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
        return view('admin.pages.articleCategory.create');
        
    }

    public function show(string $id)
    {
    

    }

    public function edit(string $id)
    {
        // $productCategory= DB::table('product_category')
        // ->where('id',$id )
        // ->get();
        $articleCategory = ArticleCategory::find($id);
        return view('admin.pages.articleCategory.detail',compact('articleCategory'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate(["name"=>"required|max:255"]);

        $articleCategory = ArticleCategory::find($id);
        $articleCategory->update(['name' => $request->name]);

        // return $this->index();
        return redirect()->route('article-category.index')->with('message', 'Update Successfully!');

    }

    public function destroy(string $id)
    {
        $articleCategory = ArticleCategory::find($id);
        // $articleCategory->delete();
        $articleCategory->forceDelete();

        return redirect()->route('article-category.index');
    }
}
