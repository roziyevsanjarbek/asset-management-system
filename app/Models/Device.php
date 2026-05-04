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
}
