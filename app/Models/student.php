<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class student extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    use SoftDeletes;
    protected $table = 'students';
    protected $primaryKey = 'student_id';
    protected $fillable = [
        'roll_no',
        'name',
        'gender',
        'nrc',
        'date_of_birth',
        'phone_no',
        'address',
        'profile',
        'email',
        'password',
        'major_id'
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function major(){
        return $this->belongsTo(Major::class, 'major_id');
    }

    public function hostel_application(){
        return $this->hasMany(Hostel_application::class, 'record_id', 'student_id');
    }
}
