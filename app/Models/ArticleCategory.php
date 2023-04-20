<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Article;

class ArticleCategory extends Model
{
    use HasFactory;
    protected $table = 'article_category';

    protected $filltable = [
        'name',
        'slug',
        'is_show'
    ];

    public function article_category(){
        return $this->belongsTo(Article::class, 'article_category');
    }
}
