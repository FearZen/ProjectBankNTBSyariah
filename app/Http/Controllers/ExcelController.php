<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FormsExport;

class ExcelController extends Controller
{
    public function export()
    {
        return Excel::download(new FormsExport, 'forms.xlsx');
    }
}
