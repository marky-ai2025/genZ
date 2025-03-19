<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'requested_by',
        'description',
        'start_time',
        'end_time',
        'status',
        'action',
    ];
}
