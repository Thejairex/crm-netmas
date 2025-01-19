<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class KYC extends Model
{
    use Notifiable;
    protected $table = 'kyc_entries';

    protected $fillable = [
        'user_id',
        'name',
        'lastname',
        'gender',
        'phone',
        'document_type',
        'document_number',
        'document_image',
        'birth_date',
        'status',
        'verified_at',
        'verified_by',
    ];


    /**
     * Rerturns the user associated with the KYC entry
     *
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
