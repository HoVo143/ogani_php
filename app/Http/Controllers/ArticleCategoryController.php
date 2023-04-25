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
        $request->validate(['name' => 'required|min:3']);

        $article = new ArticleCategory();
        $article->name = $request->name;
        $article->is_show = $request->is_show;
        $article->save();
        // ArticleCategory::insert(['name' => $request->name ,'created_at' => now(), 'updated_at' =>now()]);

        //  or
        // $productCategory = ProductCategory::create(['name' => $request->name]);
        // $productCategory = new ProductCategory;
        // $productCategory->name = $request->name;
        // $productCategory->save();
        // $productCategory = ProductCategory::where(['name', 'like', '%d%'])->get();
        // $productCategory = ProductCategory::orderBy('id')->get();



        return redirect()->route('article-category.index');
    }


    public function create()
    {
        return view('admin.pages.articleCategory.create');
        
    }

    public function show(string $id)
    {
    

    }

    // cách edit cũ
    // public function edit(string $id)
    // {
    //     // $productCategory= DB::table('product_category')
    //     // ->where('id',$id )
    //     // ->get();
    //     $articleCategory = ArticleCategory::find($id);
    //     return view('admin.pages.articleCategory.detail',compact('articleCategory'));
    // }

    // cách edit ngắn gọn nhất
    public function edit(ArticleCategory $articleCategory)
    {
       
        return view('admin.pages.articleCategory.detail')->with('articleCategory',$articleCategory);
    }

    public function update(Request $request, string $id)
    {
        $request->validate(["name"=>"required|max:255", "is_show" => 'required']);

        $articleCategory = ArticleCategory::find($id);
        
        $articleCategory->update(['name' => $request->name, 'is_show' => $request->is_show ,'created_at' => now(), 'updated_at' =>now()]);

        // return $this->index();
        return redirect()->route('article-category.index')->with('message', 'Update Successfully!');

    }

 

    // public function destroy(string $id)
    // {
    //     $articleCategory = ArticleCategory::find($id);
    //     // $articleCategory->delete();
    //     $articleCategory->forceDelete();

    //     return redirect()->route('article-category.index');
    // }

    public function destroy(ArticleCategory $articleCategory)
    {
       
        $articleCategory->delete();
        return redirect()->route('article-category.index');
    }
}
