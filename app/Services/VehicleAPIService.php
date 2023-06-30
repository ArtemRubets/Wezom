<?php

namespace App\Services;

use App\Services\Concerns\VehicleClient;

class VehicleAPIService
{
    use VehicleClient;

    public function __construct(
        private readonly string $baseUrl,
    ){}

    public function decodeVIN(string $VIN, array $params = [])
    {
        return $this->getRequest("/vehicles/decodevinvalues/$VIN", array_merge([
            'format' => 'json'
        ], $params))->json();
    }
}
