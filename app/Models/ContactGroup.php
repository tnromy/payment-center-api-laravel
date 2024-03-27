<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactGroup extends Model
{
    use HasFactory, SoftDeletes;

    public function contactGroupType() {
        return $this->belongsTo(ContactGroupType::class);
    }

    protected $fillable = [
        'name',
        'contact_group_type_id'
    ];
}
