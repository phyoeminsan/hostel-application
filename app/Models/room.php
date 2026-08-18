<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class room extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'rooms';
    protected $primaryKey = 'room_id';
    protected $fillable = [
        'room_no',
        'floor_no',
        'no_of_person',
        'status',
        'hostel_id',
    ];

    public function hostel(){
        return $this->belongsTo(Hostel::class);
    }
}
