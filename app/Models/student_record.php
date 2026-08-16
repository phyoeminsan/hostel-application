<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class student_record extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'student_records';
    protected $fillable = [
        'academic_year_id',
        'year_id',
        'student_id',
    ];
}
