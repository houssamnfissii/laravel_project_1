<?php

namespace App\Http\Controllers;

use App\Exports\TripsExport;
use App\Imports\TripsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TripexController extends Controller
{
    public function export()
    {
        $columns = [
            'destination',
            'start_date',
            'end_date',
            'max_participants',
            'price',
            'description',
            'city',
            'status',
            'image_1',
            'image_2',
            'image_3'
        ];

        return Excel::download(new TripsExport($columns), 'trips.xlsx');
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new TripsImport, $request->file('file'));

        return redirect()->back()->with('success', 'Trips imported successfully.');
    }
}
