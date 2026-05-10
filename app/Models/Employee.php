<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
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
}
