<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ojt extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'age', 'school', 'course', 'program', 'qr_code'];

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }
}
