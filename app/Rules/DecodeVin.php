<?php

namespace App\Rules;

use App\Services\VehicleAPIService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DecodeVin implements ValidationRule
{

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $vehicleAPIService = app(VehicleAPIService::class);

        $vehicleByVIN = $vehicleAPIService->decodeVIN($value);

        $errors = $vehicleAPIService->errorHandler($vehicleByVIN);

        foreach ($errors as $error){
            $fail($error);
        }
    }


}
