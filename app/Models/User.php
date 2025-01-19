<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'password',
        'email',
        'role',
        'status',
        'balance_points',
        'kyc_status',
        'name',
        'lastname',
        'gender',
        'phone',
        'document_type',
        'document_number',
        'birth_date',
        'rank_id',
        'next_rank_id',
        'parent_id',
    ];

    protected $hidden = [
        'document_number',
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];


    // En el modelo User
    public function linkedAccounts()
    {
        return $this->belongsToMany(User::class, 'linked_accounts', 'user_id', 'linked_account_id');
    }

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = Hash::make($value);
    }

    public function isAdmin() {
        return $this->role === 'admin';
    }

    public function isVerified() {
        return $this->kyc_status === 'verified';
    }

    public function parent(): BelongsTo {
        /**
         * Returns the parent of the user if it exists
         */
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function children(): HasMany {
        /**
         * Returns the children of the user if it exists
         */
        return $this->hasMany(User::class, 'parent_id');

    }

    public function kyc()
    {
        return $this->hasOne(KYC::class);
    }

    public function rank(): BelongsTo
    {
        return $this->belongsTo(Ranks::class);
    }

    public function nextRank(): BelongsTo
    {
        return $this->belongsTo(Ranks::class, 'next_rank_id');
    }

    public function referralLink(): string
    {
        return route('register', ['ref' => $this->username]);
    }
}
