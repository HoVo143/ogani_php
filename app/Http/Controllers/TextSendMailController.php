<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TextSendMailController extends Controller
{
    public function sendMail(){

        $name = Auth::user()->name; // user dang nhap hien tai -> name
        //send mail
        //cach 1
        $arrayMail = ['adadad077@gmail.com', 'congdanh785@gmail.com']; // ca 2 gmail deu nhan thong tin 
        Mail::to($arrayMail)->send(new TestMail($name)); // noi dung mail nam ben testmail

        //cach 2
        foreach($arrayMail as $email){
            Mail::to($email)->send(new TestMail($name)); // noi dung mail nam ben testmail
        }
    }
}
