<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['ojt_id', 'attendance_time'];

    public function ojt()
    {
        return $this->belongsTo(Ojt::class);
    }
}
