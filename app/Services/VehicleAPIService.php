<?php

namespace App\Services;

use App\Services\Concerns\VehicleClient;

class VehicleAPIService
{
    use VehicleClient;

    public function __construct(
        private readonly string $baseUrl,
    ){}

    public function decodeVIN(string $VIN, array $params = []): array
    {
        return $this->getRequest("/vehicles/decodevinvalues/$VIN", array_merge([
            'format' => 'json'
        ], $params))->json();
    }

    public function getAllBrands(array $params = []): array
    {
        return $this->getRequest("/vehicles/getallmakes", array_merge([
            'format' => 'json'
        ], $params))->json();
    }

    public function getAllModelsByBrandId(int $brandId, array $params = []): array
    {
        return $this->getRequest("/vehicles/getmodelsformakeid/$brandId", array_merge([
            'format' => 'json'
        ], $params))->json();
    }

    public function errorHandler(array $response): array
    {
        if ($response['Results'][0]['ErrorCode'] != 0){
            $errCodes = explode(',', $response['Results'][0]['ErrorCode']);

            $errorsText = $response['Results'][0]['ErrorText'];

            foreach ($errCodes as $errCode) {
                $errorsText = str_replace($errCode, '|' . $errCode, $errorsText);
            }

            $errorsArray = explode('|', $errorsText);
            array_shift($errorsArray);

            return $errorsArray;
        }

        return [];
    }
}
