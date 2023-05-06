<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class ProductCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $filltable = ['name', 'image_url'];

    protected $table = 'product_category';

    public $timestamps = true;

    public function products()
    {
        return $this->hasMany(Product::class, 'product_category_id');
    }
    // $table->forceDelete();
    // public function getAll(){
    //     return DB::table('product_category')->get();
    // }
    // public function addProduct($request)
    // {

    //     return DB::table('product_category')->insert([
    //         'name' => $request->name,

           
    //     ]);
    // }
}
