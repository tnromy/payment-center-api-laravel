<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Folder extends Model
{
    use HasFactory, SoftDeletes, Searchable;

     public function toSearchableArray() {
        return [
        'name'
        ];
    }

    protected $fillable = [
        'email_id',
        'name',
    ];
}
