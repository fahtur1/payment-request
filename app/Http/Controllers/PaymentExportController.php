<?php

namespace App\Http\Controllers;

use App\Exports\PaymentExportWithChange;
use App\Exports\PaymentExportWithoutChange;
use App\Models\PaymentRequest;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;



class PaymentExportController extends Controller
{
    public function export(PaymentRequest $id)
    {
        $grandTotal = 0;
        $budget = 0;

        foreach ($id->item as $item) {
            $grandTotal += $item->settlement_amount;
            $budget += $item->amount;
        }

        $change = $budget - $grandTotal;

        $randomName = uniqid();

        $fileNameExcel = 'settlement-' . date('d-m-Y') . '-' . $randomName . '.xlsx';

        if ($change <= 0) {
            return Excel::download(new PaymentExportWithoutChange($id), $fileNameExcel);
        } else {
            return Excel::download(new PaymentExportWithChange($id, $change), $fileNameExcel);
        }
    }

    function exportPdf($id)
    {
        $payment = PaymentRequest::find($id);
        $fileNamePdf = 'settlement-' . date('d-m-Y') . '-' . uniqid() . '.pdf';

        $pdf = PDF::loadView('pdf.bukti_settle', ['payment' => $payment]);
        return $pdf->download($fileNamePdf);
    }

    function rupiah($angka)
    {
        return "Rp " . number_format($angka, 2, ',', '.');
    }
}
