<?php

namespace App\Services\Factories;

use App\Services\VehicleAPIService;
use Illuminate\Support\Facades\App;

class VehicleAPIFactory
{
    public function make()
    {
        return app()->make(VehicleAPIService::class);
    }
}
