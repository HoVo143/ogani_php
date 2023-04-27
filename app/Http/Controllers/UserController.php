<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRequest;
use App\Http\Requests\UserSaveRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    private $model;
    
    public function __construct(User $userModel)
    {
        $this->model = $userModel;
    }
    // SQL RAW
    public function store(UserSaveRequest $request)
    {
        // $request->validate([ // required nếu ko nhập thông tin form sẽ ko chuyển trang
        //     'name' => 'required|min:3', // min:3 không được để trống 3 kí tự
        //     'phone' => 'required|min:3',
        //     'email' => 'required|email|unique:user_form,email', // báo lỗi khi trùng email
        //     'password' => 'required|confirmed', // dùng |confirmed khác password sẽ ko load
        //     'status' => 'required',
        //     // 'password_confirmation' => 'required',
        // ], 
        // [
        //     'name.required' => 'khong duoc de trong',
        //     'name.min' => 'nhap tren 3 ky tu',
        //     'email.unique' => 'Trung roi!!!',
        //     'status.required' => 'khong duoc de trong',

        // ]
        // );

        $request = $request->except('_token' ,'password_confirmation'); // bo~ _token
        $request[] = date('Y-m-d H:i:s');
        $request[] = date('Y-m-d H:i:s');
        $request['password'] = Hash::make($request['password']); // mã hóa password
        // dd($request);

        DB::insert('INSERT INTO user_form ( name ,phone, email, password ,status , is_admin, created_at, updated_at) 
        values ( ?, ?, ?, ?, ?, ?, ?, ?)', 
        // [ $request['name'], $request['phone'], $request['email'], $request['password'], date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
            array_values($request)

        );
        // flash data in laravel
        return redirect()->route('admin.user.userlist')->with('message','Thanh Cong!!!'); // key la message
        //redirect về link 'admin.user.userlist' kèm theo biến message 
    }

    public function index()
    {
        // ------------------------ SQL RAW -----------------------------------------------------------------------------
        // $user= DB::select('SELECT * FROM user_form');

        // ------------------------ QUERY BUiLDER -----------------------------------------------------------------------------
        // $user = DB::table('user_form')->get();

        $user = $this->model->getAll();
        return view('admin.pages.user.userlist', ['user' => $user]);
    }

    // -------------------------------------------show----------------------------------------------------------------------
    public function show($id){

        // DB::enableQueryLog(); // kiểm tra sql
        // $user= DB::select('SELECT * FROM user_form WHERE id = :id', ['id' =>$id]);
        // dd(DB::getQueryLog());// kiểm tra sql
        // $user= DB::select('SELECT * FROM user_form WHERE id = ?', [$id]);

        $user = $this->model->showDetal($id);
        return view('admin.pages.user.userdetal')->with('user', $user[0]); //[0] để chắc chắn trả về 1 gia tri
    }



    // -------------------------------------------update----------------------------------------------------------------------
    public function update(UpdateRequest $request){
        
        // $request->validate([ // required nếu ko nhập thông tin form sẽ ko chuyển trang
        //     'name' => 'required|min:3', // min:3 không được để trống 3 kí tự
        //     'phone' => 'required|min:3',
        //     'email' => 'required|email|unique:user_form,email,' . $request->get('id'), // báo lỗi khi trùng email 
        //     // $request->get('id') tránh báo lỗi lại gmail khi ko sửa gmail
        //     'status' => 'required',

        // ], 
        // [
        //     'name.required' => 'khong duoc de trong',
        //     'name.min' => 'nhap tren 3 ky tu',
        //     'email.unique' => 'Trung roi!!!',
        //     'status.required' => 'khong duoc de trong',

        // ]
        // );
        // dd($request);
        $data = $request->except('_token', 'password','password_confirmation');
        $data['updated_at'] = date('Y-m-d H:i:s');
        // dd($data);

        // $bool = DB::update('UPDATE user_form set name = :name , phone = :phone 
        // , email = :email , status = :status , updated_at = :updated_at where id = :id' ,$data);
        $bool = $this->model->upDates($data);
        $message = 'That bai';
        if($bool){
            $message = 'thanh cong';
        }

        // flash data in laravel
        return redirect()->route('admin.user.userlist')->with('message',$message); // key la message
        //redirect về link 'admin.user.userlist' kèm theo biến message 
    }


     // -------------------------------------------delete----------------------------------------------------------------------
     public function destroy($id)
     {
        // $bool = DB::delete('DELETE from user_form where id = ?' ,[$id]);
        $bool = $this->model->Deletes($id);
        
        $message = 'That bai';
        if($bool){
            $message = 'thanh cong';
        }
        // flash data in laravel
        return redirect()->route('admin.user.userlist')->with('message',$message); // key la message
        //redirect về link 'admin.user.userlist' kèm theo biến message 
    }


    public function giaodienlogin()
    {
        return view('client.pages.login.login');
    }

    public function dangnhap(Request $request){

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        // dd($credentials);
        if(Auth::attempt($credentials))
        {
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'ten dang nhap hoac mat khau khong dung',
        ])->onlyInput('email');
    }

    public function dangxuat(){
        Auth::logout();
        return redirect()->route('home');
    }
}
// BUỔI SAU XÓA MỀM



