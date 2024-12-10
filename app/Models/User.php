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
    use HasFactory;

    protected $fillable = [
        'name',
        'lastname',
        'password',
        'role',
        'email',
        'parent_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];
    

    // public function linkedAccounts(): HasMany
    // {
    //     return $this->hasMany(LinkedAccount::class, 'user_id');
    // }

    // En el modelo User
    public function linkedAccounts()
    {
        return $this->belongsToMany(User::class, 'linked_accounts', 'user_id', 'linked_user_id');
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
        return $this->belongsTo(User::class);
    }

    public function children(): HasMany {
        /**
         * Returns the children of the user if it exists         
         */
        return $this->hasMany(User::class);
    }
}
