<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{

    protected $table = 'devices';
    protected $fillable = [
        'device_type_id',
        'serial_number',
        'inventory_number',
        'name',
    ];

    public function deviceType()
    {
        return $this->belongsTo(DeviceType::class);
    }

    public function deviceDetails()
    {
        return $this->hasMany(DeviceDetail::class);
    }

    public function deviceAssignments()
    {
        return $this->hasMany(DeviceAssignment::class);
    }
}
