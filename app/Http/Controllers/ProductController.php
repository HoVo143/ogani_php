<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductSaveRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    private $modelproduct;

    public function __construct(Product $productModel)
    {
        $this->modelproduct = $productModel;
    }

    public function store(ProductSaveRequest $request)
    {
        $bool = $this->modelproduct->addProduct($request);
        $message = 'That bai';
        if($bool){
            $message = 'thanh cong';
        }

        return redirect()->route('admin.product.productlist')->with('message',$message);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product= $this->modelproduct->getAll();

        return view('admin.pages.product.productlist', ['product' => $product]);

    }


    public function create()
    {
        //
    }

    public function show( $id)
    {
        // $product= DB::select('SELECT * FROM product WHERE id = :id', ['id' =>$id]);
        $product=$this->modelproduct->showAll($id);
        return view('admin.pages.product.detailproduct')->with('product', $product[0]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        // $request->$request;
        // $request->except('_token');
        $bool = $this->modelproduct->updateProduct($request,$id);

        $message = 'That bai';
        if($bool){
            $message = 'thanh cong';
        }

        return redirect()->route('admin.product.productlist')->with('message',$message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bool = $this->modelproduct->Deletes($id);
        
        $message = 'That bai';
        if($bool){
            $message = 'thanh cong';
        }
        // flash data in laravel
        return redirect()->route('admin.product.productlist')->with('message',$message); // key la message
        //redirect về link 'admin.user.userlist' kèm theo biến message 
    }
}
