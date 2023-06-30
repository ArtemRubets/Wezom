<?php

namespace App\Virtual\API\v1\Controllers;

use OpenApi\Annotations as OA;

/**
 *
 * @OA\Post(
 *      path="/api/v1/vehicles/",
 *      tags={"Vehicles"},
 *      summary="Create new vehicle",
 *      description="Create new vehicle",
 *      @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="name",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="state_number",
 *                     type="string"
 *                 ),
 *                  @OA\Property(
 *                     property="color",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="vin_code",
 *                     type="string"
 *                 ),
 *                 example={
 *                      "name": "Brad",
 *                      "state_number": "BM4632BX",
 *                      "color": "black",
 *                      "vin_code": "3VWDP7AJ7DM356782",
 *                 }
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *          @OA\JsonContent(
 *              @OA\Property(property="data", type="object",
 *                  ref="#/components/schemas/VehicleResource"
 *              ),
 *          )
 *      )
 * )
 */

class VehiclesController
{

}
