<?php

namespace App\Exports\API\v1;

use App\Services\VehicleService;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Scout\Builder as ScoutBuilder;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VehiclesExport implements FromQuery, ShouldAutoSize, WithHeadings
{
    use Exportable;

    private $fileName = 'vehicles.xls';

    private $query;

    public function __construct(
        private Request $request,
    ){
        $this->query = app(VehicleService::class)->getSortedAndFilteredVehicles($request);
    }

    public function query()
    {
        if ($this->query instanceof Builder) {
            return $this->query;
        }

        if ($this->query instanceof ScoutBuilder) {
            return $this->query->get()->toQuery();
        }
    }

    public function headings(): array
    {
        return [
            '#',
            'Name',
            'State Number',
            'Color',
            'VIN Code',
            'Model',
            'Brand',
            'Year',
            'Created At',
            'Updated At',
        ];
    }
}
