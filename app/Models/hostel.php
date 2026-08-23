<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class hostel extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'hostels';
    protected $primaryKey = 'hostel_id';
    protected $fillable = [
        'hostel_name',
        'image',
        'gender',
        'capacity',
    ];
}
