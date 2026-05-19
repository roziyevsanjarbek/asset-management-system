<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = [
        'full_name',
        'email',
        'phone_number',
    ];


    public function deviceAssignments()
    {
        return $this->hasMany(DeviceAssignment::class);
    }

    public function devices()
    {
        return $this->belongsToMany(
            Device::class,
            'device_assignments',
            'employee_id',
            'device_id'
        )
            ->withPivot(['start_date', 'end_date'])
            ->withTimestamps();
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
