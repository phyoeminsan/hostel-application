<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\hostel_application;

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

    public function hostel_application(){
        return $this->hasMany(Hostel_application::class, 'hostel_id','hostel_id');
    }

    public function getAvailableCapacityAttribute()
    {
        // Admin မှ အတည်ပြုထားသော (approved) ကျောင်းသားအရေအတွက်ကို ရေတွက်မည်
        $approvedCount = $this->hostel_application()->where('status', 'approved')->count();

        // မူလ Capacity ထဲမှ လက်ခံထားသော အရေအတွက်ကို နှုတ်မည်
        $available = $this->capacity - $approvedCount;

        // နုတ်လို့ ရလာဒ် - ဖြစ်သွားပါက 0 ဟုသာ ပြမည်
        return $available > 0 ? $available : 0;
    }
}
