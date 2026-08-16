<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class hostel_allocation extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'hostel_allocations';
    protected $fillable = [
        'payment_id',
        'room_id',
        'allocation_date',
        'status',
        'description',
    ];
}
