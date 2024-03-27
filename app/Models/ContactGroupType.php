<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactGroupType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon_path'
    ];
}
