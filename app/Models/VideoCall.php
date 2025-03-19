<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoCall extends Model {
    use HasFactory;

    protected $fillable = ['caller_id', 'receiver_id', 'status'];

    public function caller() {
        return $this->belongsTo(User::class, 'caller_id');
    }

    public function receiver() {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
