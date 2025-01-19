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
        'is_supplier_pack',
        'category_id',
    ];

    public function getTotalPrice()
    {
        return $this->price - ($this->price * ($this->discount / 100));
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
