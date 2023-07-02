<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Store extends Authenticatable
{
    use HasFactory;
    protected $guarded = [];


    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
