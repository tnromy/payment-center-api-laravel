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

    public function user() {
        return $this->belongsToMany(User::class, 'contact_group_accesses')->withTimestamps();
    }

    protected $fillable = [
        'name',
        'contact_group_type_id',
        'last_use'
    ];

     public function contact() {
        return $this->belongsToMany(Contact::class, 'contact_group_members')->withTimestamps();
    }

}
