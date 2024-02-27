<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Email extends Model
{
    use HasFactory, SoftDeletes, Searchable;

     public function toSearchableArray() {
        return [
        'host',
        'port',
        'username',
        'from_addr',
        'from_name',
        ];
    }

    protected $fillable = [
        'user_id',
        'host',
        'port',
        'username',
        'password',
        'enc',
        'from_addr',
        'from_name',
    ];
}
