<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class hostel_application extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'hostel_applications';
    protected $fillable = [
        'record_id',
        'hostel_id',
        'status',
    ];
}
