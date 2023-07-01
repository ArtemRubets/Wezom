<?php

namespace App\Virtual\API\v1\Controllers;

use OpenApi\Annotations as OA;

/**
 *
 * @OA\Post(
 *      path="/api/v1/vehicles/",
 *      tags={"Vehicles"},
 *      summary="Create a new vehicle",
 *      description="Create a new vehicle",
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(ref="#/components/schemas/VehicleInput")
 *      ),
 *      @OA\Response(
 *           response=201,
 *           description="Successful operation",
 *           @OA\JsonContent(
 *               @OA\Property(property="data", type="object",
 *                   ref="#/components/schemas/VehicleResource"
 *               ),
 *           )
 *      )
 * )
 *
 *
 * @OA\Get(
 *      path="/api/v1/vehicles/",
 *      tags={"Vehicles"},
 *      summary="Get a list of vehicles",
 *      description="Get a list of vehicles",
 *      @OA\Parameter(
 *          name="brand",
 *          description="Filter by Brand",
 *          required=false,
 *          example="Ford",
 *          in="query",
 *          @OA\Schema(
 *              type="string"
 *          )
 *      ),
 *      @OA\Parameter(
 *           name="model",
 *           description="Filter by Model",
 *           required=false,
 *           example="Fusion",
 *           in="query",
 *           @OA\Schema(
 *               type="string"
 *           )
 *      ),
 *      @OA\Parameter(
 *           name="year",
 *           description="Filter by Model year",
 *           required=false,
 *           example=2017,
 *           in="query",
 *           @OA\Schema(
 *               type="integer"
 *           )
 *      ),
 *      @OA\Parameter(
 *            name="sort_by",
 *            description="Colunm for sorting",
 *            required=false,
 *            example="year",
 *            in="query",
 *            @OA\Schema(
 *                type="string",
 *                enum={
 *                      "brand",
 *                      "model",
 *                      "year",
 *                      "state_number",
 *                      "vin_code",
 *                      "name",
 *                      "color",
 *                      "created_at",
 *                      "updated_at"
 *                }
 *            )
 *      ),
 *      @OA\Parameter(
 *            name="sort_order",
 *            description="Sort direction",
 *            required=false,
 *            example="desc",
 *            in="query",
 *            @OA\Schema(
 *                type="string",
 *                enum={
 *                      "asc",
 *                      "desc",
 *                }
 *            )
 *      ),
 *      @OA\Parameter(
 *            name="search",
 *            description="Search string",
 *            required=false,
 *            example="3FA6P0VP1HR282209",
 *            in="query",
 *            @OA\Schema(
 *                type="string"
 *            )
 *       ),
 *      @OA\Response(
 *           response=200,
 *           description="Successful operation",
 *           @OA\JsonContent(
 *               @OA\Property(property="data", type="object",
 *                   ref="#/components/schemas/VehicleResource"
 *               ),
 *               @OA\Property(property="links", type="object",
 *                   @OA\Property(property="first", type="string"),
 *                   @OA\Property(property="last", type="string"),
 *                   @OA\Property(property="prev", type="string", nullable=true),
 *                   @OA\Property(property="next", type="string", nullable=true),
 *               ),
 *               @OA\Property(property="meta", type="object",
 *                   @OA\Property(property="current_page", type="integer"),
 *                   @OA\Property(property="from", type="integer"),
 *                   @OA\Property(property="last_page", type="integer"),
 *                   @OA\Property(property="links", type="array",
 *                      @OA\Items(
 *                          @OA\Property(property="url", type="string", nullable=true),
 *                          @OA\Property(property="label", type="string"),
 *                          @OA\Property(property="active", type="boolean")
 *                      )
 *                   ),
 *                   @OA\Property(property="path", type="string"),
 *                   @OA\Property(property="per_page", type="integer"),
 *                   @OA\Property(property="to", type="integer"),
 *                   @OA\Property(property="total", type="integer"),
 *               ),
 *               example={
 *                  "data": {
 *                      {
 *                          "name": "Brad",
 *                          "state_number": "BM3452BX",
 *                          "color": "black",
 *                          "vin_code": "3FA6P0VP1HR282209",
 *                          "model": "Fusion",
 *                          "brand": "FORD",
 *                          "year": "2017"
 *                      },
 *                      {
 *                          "name": "Brad",
 *                          "state_number": "BM3X",
 *                          "color": "black",
 *                          "vin_code": "3VWDP7AJ7DM356782",
 *                          "model": "Jetta",
 *                          "brand": "VOLKSWAGEN",
 *                          "year": "2013"
 *                      },
 *                   },
 *                   "links": {
 *                      "first": "http://127.0.0.1/api/v1/vehicles?page=1",
 *                      "last": "http://127.0.0.1/api/v1/vehicles?page=1",
 *                      "prev": null,
 *                      "next": null
 *                   },
 *                   "meta": {
 *                      "current_page": 1,
 *                      "from": 1,
 *                      "last_page": 1,
 *                      "links": {
 *                          {
 *                              "url": null,
 *                              "label": "&laquo; Previous",
 *                              "active": false
 *                          },
 *                          {
 *                              "url": "http://127.0.0.1/api/v1/vehicles?page=1",
 *                              "label": "1",
 *                              "active": true
 *                          },
 *                          {
 *                              "url": null,
 *                              "label": "Next &raquo;",
 *                              "active": false
 *                          }
 *                      },
 *                      "path": "http://127.0.0.1/api/v1/vehicles",
 *                      "per_page": 10,
 *                      "to": 3,
 *                      "total": 3
 *                   }
 *              }
 *           )
 *       )
 * )
 *
 * @OA\Get(
 *      path="/api/v1/vehicles/{id}",
 *      tags={"Vehicles"},
 *      summary="Get vehicle data",
 *      description="Get vehicle data",
 *      @OA\Parameter(
 *          name="id",
 *          description="Vehicle id",
 *          required=true,
 *          example=1,
 *          in="path",
 *          @OA\Schema(
 *              type="integer"
 *          )
 *      ),
 *      @OA\Response(
 *           response=200,
 *           description="Successful operation",
 *           @OA\JsonContent(
 *               @OA\Property(property="data", type="object",
 *                   ref="#/components/schemas/VehicleResource"
 *               ),
 *           )
 *       ),
 *      @OA\Response(
 *           response=404,
 *           description="Not found"
 *      ),
 * )
 *
 * @OA\Delete(
 *      path="/api/v1/vehicles/{id}",
 *      tags={"Vehicles"},
 *      summary="Delete a vehicle",
 *      description="Delete a vehicle",
 *      @OA\Parameter(
 *          name="id",
 *          description="Vehicle id",
 *          required=true,
 *          example=1,
 *          in="path",
 *          @OA\Schema(
 *              type="integer"
 *          )
 *      ),
 *      @OA\Response(
 *           response=204,
 *           description="Successful operation",
 *       ),
 *      @OA\Response(
 *           response=404,
 *           description="Not found"
 *      ),
 * )
 *
 * @OA\Patch(
 *      path="/api/v1/vehicles/{id}",
 *      tags={"Vehicles"},
 *      summary="Update the vehicle",
 *      description="Update the vehicle",
 *      @OA\Parameter(
 *           name="id",
 *           description="Vehicle id",
 *           required=true,
 *           example=1,
 *           in="path",
 *           @OA\Schema(
 *               type="integer"
 *           )
 *       ),
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(ref="#/components/schemas/VehicleInput")
 *     ),
 *     @OA\Response(
 *          response=201,
 *          description="Successful operation",
 *          @OA\JsonContent(
 *              @OA\Property(property="data", type="object",
 *                  ref="#/components/schemas/VehicleResource"
 *              ),
 *          )
 *      ),
 *     @OA\Response(
 *           response=404,
 *           description="Not found"
 *      ),
 * )
 *
 */

class VehiclesController
{

}
