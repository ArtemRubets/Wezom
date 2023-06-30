<?php

namespace App\Services;

use App\DataTransfers\API\v1\VehicleByVinDTO;
use App\Models\Vehicle;

class VehicleService
{
    public function __construct(private VehicleAPIService $vehicleAPIService){}

    public function storeVehicle(array $data): Vehicle
    {
        $vehicleByVIN = $this->vehicleAPIService->decodeVIN($data['vin_code']);

        $dto = VehicleByVinDTO::toArray($vehicleByVIN);

        $mergedData = array_merge($data, $dto);

        return Vehicle::create($mergedData);
    }
}
