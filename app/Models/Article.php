<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ArticleCategory;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'article';

    protected $filltable = [
        'name',
        'slug',
        'description',
        'author',
        'tags',
        'is_show',
        'is_approved',
        'article_category_id'
    ];
    public function article_category(){
        return $this->belongsTo(ArticleCategory:: class, 'article');
    }
}
