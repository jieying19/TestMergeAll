<?php

namespace App\Models;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    protected $table = "students";

    protected $primaryKey = 'student_id';

    protected $fillable = [
        'student_name',
        'student_age',
        'student_birthRegNo',
        'student_ic',
        'student_health',
        'student_birthPlace',
        'student_homeAddress',
        'student_regStatus',
    ];

}
