<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    protected $keyType = "string";

    protected $fillable = [
        'id',
        'username',
        'full_name',
        'email',
        'phone',
            'password',
            'remember_me',
            'is_active',

            'added_by_user_id',
            'updated_by_user_id',
            'deleted_by_user_id',
            'added_by_ip_addr',
            'updated_ip_addr',
            'deleted_ip_addr',

    ];

    public function toSearchableArray() {
        return [
        'username',
        'full_name',
        'email',
        'phone',
        ];
    }

    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
