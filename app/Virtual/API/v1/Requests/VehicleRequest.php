<?php

namespace App\Virtual\API\v1\Requests;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="VehicleInput",
 *     title="Vehicle Input",
 *     required={"name", "state_number", "color", "vin_code"},
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *     ),
 *     @OA\Property(
 *         property="state_number",
 *         type="string",
 *     ),
 *      @OA\Property(
 *         property="color",
 *         type="string",
 *     ),
 *     @OA\Property(
 *         property="vin_code",
 *         type="string",
 *     ),
 *     example={
 *          "name": "Brad",
 *          "state_number": "BM4632BX",
 *          "color": "black",
 *          "vin_code": "3VWDP7AJ7DM356782",
 *     }
 * )
 *
 */

class VehicleRequest
{

}
