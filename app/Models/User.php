<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'user_form';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAll(){
        return DB::table('user_form')->get();
    }

    public function showDetal($id){
        return DB::select('SELECT * FROM user_form WHERE id = :id', ['id' =>$id]);
    }
    
    public function upDates($data){
        return DB::update('UPDATE user_form set name = :name , phone = :phone 
        , email = :email , status = :status , updated_at = :updated_at where id = :id' ,$data);
    }

    public function Deletes($id){
        return DB::delete('DELETE from user_form where id = ?' ,[$id]);
    }
}
