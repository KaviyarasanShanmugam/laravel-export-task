<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeeTask;
use App\Exports\EmployeeExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Jobs\ExportExcelJob;

class ExportController extends Controller
{
    //

    public function index ()
    {
        $filePath = 'employee_report.xlsx';
        $data['file_exits'] = Storage::disk('public')->exists($filePath);
        return view('welcome', $data);
    }

    public function export () 
    {
        ExportExcelJob::dispatch();
        return redirect()->back()->with('success', 'Export process started. Please wait few min. After that you refersh it you would see download button');
 
    }



    public function downloadEmployeeReport()
    {
        $filePath = 'employee_report.xlsx';

        if (Storage::disk('public')->exists($filePath)) {
            $file = storage_path('app/public/' . $filePath);
            $response = response()->download($file);
            return $response;
        } else {
            return response()->json(['error' => 'File not found.'], 404);
        }
    }
}
