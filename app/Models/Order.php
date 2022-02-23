<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'price','type','user_id'
    ];
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function dineIns()
    {
        return $this->hasMany(DineIn::class);
    }
    public function delivery()
    {
        return $this->hasMany(Delivery::class);
    }
	public function order_details() {
		return $this->belongsToMany(OrderItem::class , 'order_items' , 'order_id' , 'item_id');     	
	}

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
