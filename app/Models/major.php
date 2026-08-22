<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class major extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'majors';
    protected $primaryKey = 'major_id';
    protected $fillable = [
        'major_name',
    ];
}
