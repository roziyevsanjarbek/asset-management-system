<?php

namespace App\Services;

use App\Models\DeviceType;
use App\Repositories\DeviceTypeRepository;

class  DeviceTypeService
{
    public function __construct(
        private DeviceTypeRepository $deviceTypeRepository
    )
    {
    }

    public function getAll()
    {
        return $this->deviceTypeRepository->getAll();
    }

    public function create(string $name)
    {
        return $this->deviceTypeRepository->create($name);
    }

    public function find($id)
    {
        return $this->deviceTypeRepository->find($id);
    }

    public function update(DeviceType $deviceType, array $data)
    {
        return $this->deviceTypeRepository->update($deviceType, $data);
    }

}

