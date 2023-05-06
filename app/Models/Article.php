<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ArticleCategory;
use Cviebrock\EloquentSluggable\Sluggable;

class Article extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $table = 'article';

    protected $filltable = [
        'title',
        'slug',
        'description',
        'author',
        'tags',
        'is_show',
        'is_approved',
        'article_category_id',
        'count_click'
    ];
    public function category(){
        return $this->belongsTo(ArticleCategory:: class, 'article_category_id')->withTrashed();
    }

    // 
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
