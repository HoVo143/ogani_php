<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function addProduct($request)
    {
        $imageName = null;
        if($request->image_url){
            $imageName = uniqid() . '_' . $request->image_url->getClientOriginalName();
            $request->image_url->move(public_path('images'), $imageName);
        }

        return DB::table('product')->insert([
            'name' => $request->name,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'description' => $request->description,
            'status' => $request->status,
            'image_url' => $imageName,

        ]);
    }

    public function updateProduct($request, $id )
    {
        $data=array( 'name' => $request->name,
        'price' => $request->price,
        'discount_price' => $request->discount_price,
        'description' => $request->description,
        'status' => $request->status,
       );

        DB::table('product')
            ->where('id' , $id)
            ->update($data);
      
    }


    public function Deletes($id){
        return DB::delete('DELETE from product where id = ?' ,[$id]);

    }
}
