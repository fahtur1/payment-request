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

        $grandTotal = 0;
        $budget = 0;

        foreach ($payment->item as $item) {
            $grandTotal += $item->settlement_amount;
            $budget += $item->amount;
        }

        $change = $budget - $grandTotal;

        $randomName = uniqid();

        $fileNameExcel = 'settlement-' . date('d-m-Y') . '-' . $randomName . '.xlsx';
        $fileNamePdf = 'settlement-' . date('d-m-Y') . '-' . $randomName . '.pdf';

        $pdf = PDF::loadView('pdf.bukti_settle', ['payment' => $payment]);

        if ($change <= 0) {
            return $pdf->download($fileNamePdf);
            return Excel::download(new PaymentExportWithoutChange($payment), $fileNameExcel);
        } else {
            $pdf->download($fileNamePdf);
            return Excel::download(new PaymentExportWithChange($payment, $change), $fileNameExcel);
        }

    }

    function rupiah($angka)
    {
        return "Rp " . number_format($angka, 2, ',', '.');
    }

}
