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
    protected $primaryKey = 'record_id';
    protected $fillable = [
        'academic_year_id',
        'year_id',
        'student_id',
    ];

    public function academic_year(){
        return $this->belongsTo(Academic_year::class, 'academic_year_id')->withTrashed();
    }

    public function year(){
        return $this->belongsTo(Year::class, 'year_id');
    }

    public function student(){
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function major(){
        return $this->belongsTo(Major::class, 'major_id');
    }
}
