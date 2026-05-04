<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceDetail extends Model
{
    protected $table = 'device_details';

    protected $fillable = [
        'device_id',
        'key',
        'value',
    ];
}
