<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function getAll(){
        return DB::table('product')->get();
    }
    public function addProduct($request)
    {
        $imageName = null;
        if($request->image_url){ //uniqid khi tải ảnh mới trùng tên ảnh cũ , ảnh ms sẽ đè lên và xóa ảnh cũ 
            $imageName = uniqid() . '_' . $request->image_url->getClientOriginalName();
            $request->image_url->move(public_path('images'), $imageName);
        }
        // $slug = implode('-', explode(' ', $request->name));
        $slug = Str::slug(($request->name));


        return DB::table('product')->insert([
            'name' => $request->name,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'description' => $request->description,
            'status' => $request->status,
            'image_url' => $imageName,
            'slug' => $slug
        ]);
    }
    public function showAll($id){

        return DB::table('product')
                ->where('id',$id )
                ->get();
    }

    public function updateProduct($request,$id)
    {
        
        // return DB::table('product')
        //     ->where('id',$id )
        //     ->update($data);
        $product = DB::table('product')->where('id',$id )->first();
        
        if($product)
        {
            $oldImage = $product->image_url;

            $imageName = null;
            if($request->image_url){// uniqid tấm hình trùng tên sẽ bị đè lên
                $imageName = uniqid() . '_' . $request->image_url->getClientOriginalName();
                $request->image_url->move(public_path('images'), $imageName);

                unlink("images/" . $oldImage);
            }
            if(!is_null($imageName)){
                $check  = DB::table('product')
                    ->where('id',$id )
                    ->update(['image_url' => $imageName]);

                // $message = $check ? 'Thanh cong' : "that bai";
                // return redirect()->route('admin.product.productlist')->with('message',$message);

            }
        }
        return '404';
    }


    public function Deletes($id){
        // return DB::delete('DELETE from product where id = ?' ,[$id]);
        return DB::table('product')->where('id' ,$id)->delete();

    }
}
