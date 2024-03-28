<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactGroupAccess extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_group_id',
        'user_id'
    ];
}
