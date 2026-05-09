<?php

namespace App\Repositories;

use App\Models\DeviceDetail;

class DeviceDetailRepository
{

    public function getAll(){
        return DeviceDetail::query()->get();
    }

    public function create(array $data){
        return DeviceDetail::query()->create($data);
    }

    public function find($id){
        return DeviceDetail::query()->find($id);
    }

    public function update(DeviceDetail $deviceDetail, array $data){
        $deviceDetail->update($data);
        return $deviceDetail;
    }

    public function delete(DeviceDetail $deviceDetail){
        return $deviceDetail->delete();
    }
}
