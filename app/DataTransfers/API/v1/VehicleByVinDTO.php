<?php

namespace App\DataTransfers\API\v1;

class VehicleByVinDTO
{

    public static function toArray($data): array
    {
        return [
            'brand' => $data['Results'][0]['Make'],
            'model' => $data['Results'][0]['Model'],
            'year' => $data['Results'][0]['ModelYear'],
        ];
    }
}
