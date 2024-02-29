<?php
namespace App\Exports;

use App\Models\Trip;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class TripsExport implements FromCollection, WithHeadings
{
    protected $columns;

    public function __construct($columns)
    {
        $this->columns = $columns;
    }

    public function collection()
    {
        return Trip::select($this->columns)->get();
    }

    public function headings(): array
    {
        return $this->columns;
    }
}
