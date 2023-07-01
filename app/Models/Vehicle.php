<?php

namespace App\Models;

use App\Helpers\Enums\VehicleSortColumns;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Attributes\SearchUsingPrefix;
use Laravel\Scout\Searchable;

class Vehicle extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'name',
        'state_number',
        'color',
        'vin_code',
        'model',
        'brand',
        'year',
    ];

    protected $casts = [
        'year' => 'integer'
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

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    #[SearchUsingFullText(['state_number', 'vin_code'])]
    #[SearchUsingPrefix(['name'])]
    public function toSearchableArray(): array
    {
        return [
            'name' => $this->name,
            'state_number' => $this->state_number,
            'vin_code' => $this->vin_code,
        ];
    }
}
