<?php

namespace App\Console\Commands\API\v1;

use App\Services\VehicleAPIService;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class UpdateAllBrandsAndModels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-all-brands-and-models';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all brands and models';

    /**
     * Execute the console command.
     */
    public function handle(VehicleAPIService $vehicleAPIService)
    {
        $allBrandsRaw = $vehicleAPIService->getAllBrands();
        $allBrands = collect($allBrandsRaw['Results']);

        $start = microtime(true);

        $allBrands->chunk(200)->each(function (Collection $chuck){
            $chuck->each(function (array $item){
                DB::table('vehicle_brands')->insert([
                    'make_id' => $item['Make_ID'],
                    'make_name' => $item['Make_Name'],
                    'created_at' => now()->toDateTimeString(),
                    'updated_at' => now()->toDateTimeString(),
                ]);
            });
        });

        DB::table('vehicle_brands')->pluck('make_id')->chunk(200)->each(function (Collection $chuck) use ($vehicleAPIService) {
            $chuck->each(function (int $id) use ($vehicleAPIService) {
                $allModelsByBrandRaw = $vehicleAPIService->getAllModelsByBrandId($id);
                $allModelsByBrand = collect($allModelsByBrandRaw['Results']);

                $allModelsByBrand->each(function (array $model){
                    DB::table('vehicle_models')->insert([
                        'model_id' => $model['Model_ID'],
                        'model_name' => $model['Model_Name'],
                        'make_id' => $model['Make_ID'],
                    ]);
                });
            });
        });


        $end = microtime(true);
        $timeTaken = round($end - $start, 2);

        $this->info("The operation took $timeTaken seconds");
    }
}
