<?php


namespace App\Services;


use App\Models\Device;
use App\Repositories\DeviceRepository;

class DeviceService
{
    public function __construct(
        private DeviceRepository $deviceRepository
    ){}

    public function getAll()
    {
        return $this->deviceRepository->getAll();
    }

    public function create(array $data)
    {
        return $this->deviceRepository->create($data);
    }

    public function find($id)
    {
        return $this->deviceRepository->find($id);
    }

    public function update(Device $device, array $data)
    {
        return $this->deviceRepository->update($device, $data);
    }

    public function delete(Device $device)
    {
        return $this->deviceRepository->delete($device);
    }
}
