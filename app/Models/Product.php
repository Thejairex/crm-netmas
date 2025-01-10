<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [

        'name',
        'description',
        'image',
        'price',
        'discount',
    ];

    public function calculateTotalPrice()
    {
        return $this->price - ($this->price * ($this->discount / 100));
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
