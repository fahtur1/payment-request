<?php

namespace App\Http\Controllers;

use App\Exports\PaymentExport;
use App\Imports\UsersImport;
use App\Models\PaymentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as PDF_FORMAT;

class PaymentExportController extends Controller
{
    public function export($id)
    {
        $payment = PaymentRequest::find(decrypt($id))->first();

        return Excel::download(new PaymentExport($payment), 'mangstaplagi.xlsx');
//        return (new PaymentExport($payment))->download('invoices.xlsx', \Maatwebsite\Excel\Excel::XLSX);
//        return Excel::download(new PaymentExport($payment), 'mantap.pdf', PDF_FORMAT::MPDF);
    }
}
