<?php

namespace App\Services;

use App\Models\DeviceDetail;
use App\Repositories\DeviceDetailRepository;

class DeviceDetailService
{

    public function __construct(
        private DeviceDetailRepository $deviceDetailRepository
    )
    {
    }

    public function getAll()
    {
        return $this->deviceDetailRepository->getAll();
    }

    public function create(array $data)
    {
        return $this->deviceDetailRepository->create($data);
    }

    public function find($id)
    {
        return $this->deviceDetailRepository->find($id);
    }

    public function update(DeviceDetail $deviceDetail, array $data)
    {
        return $this->deviceDetailRepository->update($deviceDetail, $data);
    }

    public function delete(DeviceDetail $deviceDetail)
    {
        return $this->deviceDetailRepository->delete($deviceDetail);
    }
}
