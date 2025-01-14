<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactAccess extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_id',
        'user_id'
    ];
}
