<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\VehicleRequest;
use App\Http\Resources\v1\VehicleCollection;
use App\Http\Resources\v1\VehicleResource;
use App\Models\Vehicle;
use App\Services\VehicleService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class VehiclesController extends Controller
{
    public function __construct(
        private VehicleService $vehicleService,
    ){}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): ResourceCollection
    {
        $vehicles = Vehicle::query()->filtered($request)->sorted($request);

        $vehicles = $vehicles->paginate(10)->withQueryString();

        return new VehicleCollection($vehicles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VehicleRequest $request): JsonResource
    {
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            $vehicle = $this->vehicleService->storeVehicle($validated);

            DB::commit();

            return new VehicleResource($vehicle);

        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle): JsonResource
    {
        return new VehicleResource($vehicle);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle): HttpResponse
    {
        $vehicle->delete();

        return Response::noContent();
    }
}
