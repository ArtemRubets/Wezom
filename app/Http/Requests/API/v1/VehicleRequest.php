<?php

namespace App\Http\Requests\API\v1;

use App\Rules\DecodeVin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VehicleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $uniqueRule = Rule::unique('vehicles', 'state_number');

        return [
            'name' => ['required'],
            'state_number' => [
                'required',
                $this->isMethod('PATCH') ? $uniqueRule->ignore($this->route('vehicle')) : $uniqueRule
            ],
            'color' => ['required'],
            'vin_code' => ['required', new DecodeVin],
        ];
    }
}
