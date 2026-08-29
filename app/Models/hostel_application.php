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
    protected $primaryKey = 'application_id';
    protected $fillable = [
        'record_id',
        'hostel_id',
        'apply_date',
        'status',
        'reason',
    ];

    public function student_record()
    {
        return $this->belongsTo(Student_record::class, 'record_id');
    }

    public function student(){
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function hostel()
    {
        return $this->belongsTo(Hostel::class, 'hostel_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'application_id', 'application_id');
    }


}
