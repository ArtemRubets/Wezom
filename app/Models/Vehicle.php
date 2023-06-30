<?php

namespace App\Models;

use App\Helpers\Enums\VehicleSortColumns;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'state_number',
        'color',
        'vin_code',
        'model',
        'brand',
        'year',
    ];

    public function scopeFiltered(Builder $query, Request $request): void
    {
        $query->when($request->brand, function (Builder $query) use ($request) {
            $query->where('brand', $request->brand);
        })
            ->when($request->model, function (Builder $query) use ($request) {
                $query->where('model', $request->model);
            })
            ->when($request->year, function (Builder $query) use ($request) {
                $query->where('year', $request->year);
            });
    }

    public function scopeSorted(Builder $query, Request $request): void
    {
        $query->when($request->sort_by && VehicleSortColumns::tryFrom($request->sort_by), function (Builder $query) use ($request) {
            $sortOrder = $request->sort_order ?? 'asc';

            $query->orderBy($request->sort_by, $sortOrder);
        });
    }
}
