<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Alias extends Model
{
    use HasFactory, SoftDeletes, Searchable;

     public function toSearchableArray() {
        return [
            'from_addr',
        'from_name'
        ];
    }

    protected $fillable  = [
        'email_id',
        'user_id',
        'from_addr',
        'from_name'
    ];
}
