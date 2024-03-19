<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, Searchable, SoftDeletes;

    public function toSearchableArray() {
        return [
        'full_name' => $this->full_name,
        'email' => $this->email,
        'phone' => $this->phone,
        'whatsapp' => $this->whatsapp,
        'telegram' => $this->telegram,
        'tel' => $this->tel,
        'addr_detail' => $this->addr_detail,
        'addr_pos_code' => $this->addr_pos_code,
        ];
    }

    protected $fillable = [
        'ava',
        'full_name',
        'email',
        'phone',
        'whatsapp',
        'telegram',
        'tel',
        'addr_detail',
        'addr_pos_code',
        'location_code'
    ];
}
