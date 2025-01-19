<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purchase extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'user_id',
        'total_amount',
        'payment_method',
        'status',
        'external_reference',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items()
{
    return $this->hasMany(PurchaseItem::class);
}
}
