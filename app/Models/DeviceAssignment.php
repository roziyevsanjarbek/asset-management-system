<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceAssignment extends Model
{
    protected $table = 'device_assignments';

    protected $fillable = [
        'device_id',
        'employee_id',
        'start_date',
        'end_date',
        'status',
    ];


    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
