<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class student extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'students';
    protected $fillable = [
        'roll_no',
        'name',
        'gender',
        'nrc',
        'date_of_brith',
        'phone_no',
        'address',
        'profile',
        'email',
        'password',
    ];
}
