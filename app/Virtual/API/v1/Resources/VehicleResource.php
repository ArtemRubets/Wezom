<?php

namespace App\Virtual\API\v1\Resources;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="VehicleResource",
 *      description="Vehicle Resource",
 *      schema="VehicleResource",
 *  )
 *
 *
 * @OA\Property(property="id", type="integer", example=1),
 * @OA\Property(property="name", type="string", example="Martin"),
 * @OA\Property(property="state_number", type="string", example="BM4632BX"),
 * @OA\Property(property="color", type="string", example="white"),
 * @OA\Property(property="vin_code", type="string", example="3VWDP7AJ7DM356782"),
 * @OA\Property(property="model", type="string", example="Jetta"),
 * @OA\Property(property="brand", type="string", example="VOLKSWAGEN"),
 * @OA\Property(property="year", type="integer", example=2013),
 * @OA\Property(property="created_at", type="string", format="date-time", example="2023-06-30T06:02:52.000000Z"),
 * @OA\Property(property="updated_at", type="string", format="date-time", example="2023-06-30T06:02:52.000000Z"),
 *
 */

class VehicleResource
{

}
