<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceCheck extends Model
{
    protected $table = 'device_checks';

    protected $fillable = [
        'device_assignment_id',
        'check_date',
        'status',
    ];

    public function deviceAssignment()
    {
        return $this->belongsTo(DeviceAssignment::class);
    }
}
