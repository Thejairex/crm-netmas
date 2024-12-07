<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinkedAccount extends Model
{
    protected $table = 'linked_accounts';

    protected $fillable = [
        'user_id',
        'linked_account_id',
        'status',
    ];

    function linkedUser()
    {
        return $this->belongsTo(User::class, 'linked_account_id');
    }
}
