<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class academic_year extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'academic_years';
    protected $primaryKey = 'academic_year_id';
    protected $fillable = [
        'academic_year',
        'status',
    ];
}
