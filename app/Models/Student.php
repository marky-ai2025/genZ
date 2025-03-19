<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'lastname',
        'firstname',
        'middlename',
        'gender',
        'birthday',
        'address',
        'school',
        'course',
        'program',
        'civilstatus',
        'religion'
    ];
}
