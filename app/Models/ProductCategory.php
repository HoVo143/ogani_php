<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class ProductCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    
    protected $table = 'product_category';
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
