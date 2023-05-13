<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItems extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'order_item';

    protected $fillable = [
        'order_id',
        'product_id',
        'qty',
        'price',
        'name',
    ];
    public function order(){
        return $this->belongsTo(Order::class, 'order_id');
    }
}
