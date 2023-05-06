<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Article;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleCategory extends Model
{
    use HasFactory ,SoftDeletes;
    protected $table = 'article_category';
    // protected $fillable = ['name'];
    public $timestamps = true;

    protected $filltable = [
        'name',
        'slug',
        'is_show'
    ];

    public function articles(){
        return $this->hasMany(Article::class, 'article_category_id');
    }
}
