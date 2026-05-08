<?php

namespace App\Repositories;

use App\Models\DeviceType;

class DeviceTypeRepository
{

    public function getAll()
    {
        return DeviceType::all();
    }
    public function create(string $name)
    {
        return DeviceType::create(['name' => $name]);
    }

    public function find($id)
    {
        return DeviceType::query()->find($id);
    }

    public function update(DeviceType $deviceType, array $data)
    {
        $deviceType->update($data);
        return $deviceType;
    }
}
