<?php

namespace App\Services;

use App\DataTransfers\API\v1\VehicleByVinDTO;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

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

    public function updateVehicle(Vehicle $vehicle, array $data): Vehicle
    {
        $dto = [];

        if ($vehicle->vin_code !== $data['vin_code']){
            $vehicleByVIN = $this->vehicleAPIService->decodeVIN($data['vin_code']);

            $dto = VehicleByVinDTO::toArray($vehicleByVIN);
        }

        $mergedData = array_merge($data, $dto);

        return tap($vehicle, function () use ($mergedData, $vehicle){
            $vehicle->update($mergedData);
        });
    }

    public function getSortedAndFilteredVehicles(Request $request)
    {
        if ($request->filled('search')){
            $vehicles = Vehicle::search($request->search)
                ->query(function (Builder $query) use ($request) {
                    $query->filtered($request)->sorted($request);
                });
        }else{
            $vehicles = Vehicle::query()->filtered($request)->sorted($request);
        }

        return $vehicles;
    }
}
