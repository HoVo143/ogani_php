<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Cviebrock\EloquentSluggable\Sluggable;
use OpenAI\Laravel\Facades\OpenAI;
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
        $articleCategory = Article::orderBy('id', 'DESC')->get();
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
        return redirect()->route('article.index')->with('message', $message);

    
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
        // $article = DB::table('article')->where('id', $id)->first();

        // return view('admin.pages.article.detail', ['article' => $article]);
        $article = Article::find($id);
        return view('admin.pages.article.detail',compact('article'));
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
        // DB::table('article')->where('id', $id)->first();
        // return redirect()->route('admin.article.list');
        $request->validate(["title"=>"required|max:255"]);

        $article = Article::find($id);
        $article->update(['title' => $request->title]);

        // return $this->index();
        return redirect()->route('article.list')->with('message', 'Update Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        // $article->delete();
        $article->forceDelete();

        return redirect()->route('article.index');
    }

    public function generate(Request $request){

        if (is_null($request->title)) {
            return;
        }

        $title = $request->title;

        $client = \OpenAI::client(config('app.openai_api_key'));
        // $client = OpenAI::client(env('OPENAI_API_KEY'));

        $result = $client->completions()->create([
            "model" => "text-davinci-003",
            "temperature" => 0.7,
            "top_p" => 1,
            "frequency_penalty" => 0,
            "presence_penalty" => 0,
            'max_tokens' => 600,
            'prompt' => sprintf('Write article about: %s', $title),
        ]);

        $content = trim($result['choices'][0]['text']);

        return response()->json(['content' => $content]);

    }
    public function getSlug(Request $request)
    {
        // $slug = implode('-', explode(' ', $request->name));
        // $slug = Str::slug($request->title);
        $slug = SlugService::createslug(Article::class, 'slug', $request->title);
        return response()->json(['title' => $slug]);
    }
}
