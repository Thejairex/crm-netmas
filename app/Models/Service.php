<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'discount',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
