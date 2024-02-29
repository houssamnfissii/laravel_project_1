<?php
namespace App\Imports;

use App\Models\Trip;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class TripsImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Trip([
            'destination' => $row['destination'],
            'start_date' => $row['start_date'],
            'end_date' => $row['end_date'],
            'max_participants' => $row['max_participants'],
            'price' => $row['price'],
            'description' => $row['description'],
            'city' => $row['city'],
            'status' => $row['status'],
            'image_1' => $row['image_1'],
            'image_2' => $row['image_2'],
            'image_3' => $row['image_3'],
        ]);
    }

    public function rules(): array
    {
        return [
            'destination' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'max_participants' => 'required|integer',
            'price' => 'required|numeric',
            'description' => 'required',
            'city' => 'required',
            'status' => 'required',
            'image_1' => 'nullable',
            'image_2' => 'nullable',
            'image_3' => 'nullable',
        ];
    }
}
