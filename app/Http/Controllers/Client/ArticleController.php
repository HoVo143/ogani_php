<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function show($id)
    {
        $array = ['19', '36', '29'];
        $article = Article::find($id);
        $article->count_click +=1;
        $article->save();
    }

}
