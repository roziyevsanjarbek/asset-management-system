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

    public function employees()
    {
        return $this->belongsToMany(
            Employee::class,
            'device_assignments',
            'device_id',
            'employee_id'
        )
            ->withPivot(['start_date', 'end_date'])
            ->withTimestamps();
    }

    public function type()
    {
        return $this->belongsTo(DeviceType::class, 'device_type_id');
    }
}
