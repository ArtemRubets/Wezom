<?php

namespace App\Helpers\Enums;

enum VehicleSortColumns: string
{
    case brand = 'brand';
    case model = 'model';
    case year = 'year';
    case state_number = 'state_number';
    case vin_code = 'vin_code';
    case name = 'name';
    case color = 'color';
    case created_at = 'created_at';
    case updated_at = 'updated_at';
}
