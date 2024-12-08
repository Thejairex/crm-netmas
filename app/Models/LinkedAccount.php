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


    /** 
     * Get the principal user.
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /** 
     * Get the user that owns the linked account.
    */
    function linkedUser()
    {
        return $this->belongsTo(User::class, 'linked_account_id');
    }
}
