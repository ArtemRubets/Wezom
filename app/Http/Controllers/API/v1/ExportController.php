<?php

namespace App\Http\Controllers\API\v1;

use App\Exports\API\v1\VehiclesExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function exportVehicles(Request $request)
    {
        return (new VehiclesExport($request))->download();
    }
}
