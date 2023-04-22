<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Cviebrock\EloquentSluggable\Sluggable;

use Cviebrock\EloquentSluggable\Services\SlugService;


class ArticleController extends Controller
{
    public function index(Request $request)
    {

        $filter = [];
        
        if(!empty($request->keyword)){
            $filter[] = ['title', 'like', '%' . $request->keyword . '%'];
        }
        if($request->is_show !== '' && !is_null($request->is_show)){
            $filter[] = ['is_show', $request->is_show ];
        }

        // click thu tu
        $sortBy = $request->input('sort-by') ?? 'id';
        $sortType = $request->input('sort-type  ');

        $sort = ['desc', 'asc'];
        if(!empty($sortType) && in_array($sortType, $sort)){
            $sortType = $sortType === 'desc' ? 'asc' : 'desc';

        }else{
            $sortType = 'desc';
        }


        $articles = Article::where($filter)->orderBy($sortBy, $sortType)->paginate(5);
        return view('admin.pages.article.list', compact('articles', 'sortBy', 'sortType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articleCategory = ArticleCategory::orderBy('id', 'DESC')->get();

        return view('admin.pages.article.create', compact('articleCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $slug = Str::slug($request->title);

        $bool = Article::insert([
            'title' => $request->title,
            'is_approved' => $request->is_approved,
            'description' => $request->description,
            'author' => $request->author,
            'tags' => $request->tags,
            'is_show' => $request->is_show,
            'article_category_id' => $request->article_category_id,
            'slug' => $slug
        ]);

        $message = 'that bai';
        if ($bool) {
            $message = 'thanh cong';
        }
        return redirect()->route('admin.article.list')->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = DB::table('article')->where('id', $id)->first();

        return view('admin.pages.article.detail', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::table('article')->where('id', $id)->first();
        return redirect()->route('admin.article.list');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
             DB::table('article')->where('id' ,$id)->delete();
            // flash data in laravel
            return redirect()->route('admin.article.list'); // key la message
    }

    public function getSlug(Request $request)
    {
        // $slug = implode('-', explode(' ', $request->name));
        // $slug = Str::slug($request->title);
        $slug = SlugService::createslug(Article::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
