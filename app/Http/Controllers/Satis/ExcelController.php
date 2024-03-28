<?php

namespace App\Http\Controllers\Satis;

use App\Exports\CustomerExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;


class ExcelController extends Controller
{
    public function downloadExcel()
    {
        return Excel::download(new CustomerExport, 'Müşteriler.xlsx');
    }

}
