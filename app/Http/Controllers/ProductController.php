<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductSaveRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    private $modelproduct;

    public function __construct(Product $productModel)
    {
        $this->modelproduct = $productModel;
    }
    // ---------------------------------------------------------------

    public function index()
    {
        // $products = DB::table('product')->get();
        $products = Product::all();
        return view('admin.pages.product.productlist', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productCategory = ProductCategory::orderBy('id', 'DESC')->get();

        return view('admin.pages.product.product', compact('productCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductSaveRequest $request)
    {
        $imageName = null;
        if ($request->image_url) {
            $imageName = uniqid() . '_' . $request->image_url->getClientOriginalName();
            $request->image_url->move(public_path('images'), $imageName);
        }

        $slug = Str::slug($request->name);

        $bool = Product::insert([
            'name' => $request->name,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'description' => $request->description,
            'status' => $request->status,
            'image_url' => $imageName,
            'product_category_id' => $request->product_category_id,
            'slug' => $slug
        ]);

        $message = 'that bai';
        if ($bool) {
            $message = 'thanh cong';
        }
        return redirect()->route('admin.product.productlist')->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = DB::table('product')->where('id', $id)->first();

        return view('admin.pages.product.detailproduct', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = DB::table('product')->where('id', $id)->first();
        if ($product) {
            $oldImage = $product->image_url;

            $imageName = null;
            if ($request->image_url) {
                $imageName = uniqid() . '_' . $request->image_url->getClientOriginalName();
                $request->image_url->move(public_path('images'), $imageName);
                unlink("images/" . $oldImage);
            }

            if (!is_null($imageName)) {
                $check = DB::table('product')->where('id', $id)
                    ->update(['image_url' => $imageName]);
                $message = $check ? 'Thanh cong' : 'That bai';
                return redirect()->route('admin.product.productlist')->with('message', $message);
            }
        }
        return '404';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getSlug(Request $request)
    {
        // $slug = implode('-', explode(' ', $request->name));
        $slug = Str::slug($request->name);
        return response()->json(['slug' => $slug]);
    }


    
    // public function store(ProductSaveRequest $request)
    // {
    //     $bool = $this->modelproduct->addProduct($request);
    //     $message = 'That bai';
    //     if($bool){
    //         $message = 'thanh cong';
    //     }

    //     return redirect()->route('admin.product.productlist')->with('message',$message);
    // }
    // /**
    //  * Display a listing of the resource.
    //  */
    // public function index()
    // {
    //     $product= $this->modelproduct->getAll();

    //     return view('admin.pages.product.productlist', ['product' => $product]);

    // }


    // public function create()
    // {
    //     //
    // }

    // public function show( $id)
    // {
    //     // $product= DB::select('SELECT * FROM product WHERE id = :id', ['id' =>$id]);
    //     $product=$this->modelproduct->showAll($id);
    //     return view('admin.pages.product.detailproduct')->with('product', $product[0]);
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(string $id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, $id)
    // {
    //     // dd($request);
    //     // $request->$request;
    //     // $request->except('_token');
    //     $bool = $this->modelproduct->updateProduct($request,$id);

    //     $message = 'That bai';
    //     if($bool){
    //         $message = 'thanh cong';
    //     }

    //     return redirect()->route('admin.product.productlist')->with('message',$message);
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(string $id)
    // {
    //     $bool = $this->modelproduct->Deletes($id);
        
    //     $message = 'That bai';
    //     if($bool){
    //         $message = 'thanh cong';
    //     }
    //     // flash data in laravel
    //     return redirect()->route('admin.product.productlist')->with('message',$message); // key la message
    //     //redirect về link 'admin.user.userlist' kèm theo biến message 
    // }
}
