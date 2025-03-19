<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id', 'full_name', 'about', 'company', 'position',
        'country', 'address', 'phone', 'email', 'twitter',
        'facebook', 'instagram', 'linkedin'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
