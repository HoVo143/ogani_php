<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
class GoogleLoginController extends Controller
{
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }

    public function callback(){
        $googleUser = Socialite::driver('google')->user();

        $user = User::where('email', $googleUser->email)->first();
        if($user){
            throw new \Exception(__('tai khoan google da ton tai'));
        }
    
        // $user = User::create(
        //     [
        //         'email' => $googleUser->email,
        //         'name' => $googleUser->name,
        //         'google_id' => $googleUser->id,
        //         'password' => Hash::make('password'),
        //     ]
        // );
        $user = User::updateOrCreate(
            ['email' => $googleUser->email],
            [
                'email' => $googleUser->email,
                'name' => $googleUser->name,
                'google_id' => $googleUser->id,
                // 'password' => Hash::make('password'),
                'password' => Hash::make('password' . '@' . $googleUser->id),
            ]
        );
        Auth::login($user);
    
        return redirect()->route('home');
    }
}
