<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Message extends Model
{
    use HasFactory, SoftDeletes, Searchable;

     public function toSearchableArray() {
        return [
            'to',
            'subject',
            'body',
        ];
    }

    protected $fillable = [
                    'message_id',
            'email_id',
            'user_id',
            'alias_id',
            'to',
            'subject',
            'body',
            'attachment',
            'is_read',
            'job_id',
    ];
}
