<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DineIn extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_charge', 'table_id','waiter_id','order_id'
    ];

    public function table() {

    	return $this->belongsTo(Table::class);
    }

    public function waiter() {

    	return $this->belongsTo(Waiter::class);
    }

    public function order() {

    	return $this->belongsTo(Order::class);
    }



}
