<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImeiValidation extends Model
{
    protected $table = 'imei_validations';

    protected $fillable = [
        'user_id',
        'imei',
        'is_valid',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
