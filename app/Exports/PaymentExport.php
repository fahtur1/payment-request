<?php

namespace App\Exports;

use App\Models\PaymentRequest;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Files\LocalTemporaryFile;
use \NumberFormatter;

class PaymentExport implements WithEvents
{
    public function __construct(PaymentRequest $payment)
    {
        $this->payment = $payment;
    }

    public function registerEvents(): array
    {
        return [
            BeforeWriting::class => function (BeforeWriting $event) {
                $event->writer->reopen(new LocalTemporaryFile(Storage::path('Eksel.xlsx')), Excel::XLSX);

                $dateRaw = date_create($this->payment->tanggal_pengajuan);
                $date = date_format($dateRaw, 'd-m-Y');

                /*
                    Payment Request
                */

                // set Nama
                $event->getWriter()->getSheetByIndex(0)->setCellValue('C5', $this->payment->staff->nama_staff);
                $event->getWriter()->getSheetByIndex(0)->setCellValue('A29', $this->payment->staff->nama_staff);

                // set Department
                $event->getWriter()->getSheetByIndex(0)->setCellValue('C6', $this->payment->staff->position->nama_position);

                // set Date
                $event->getWriter()->getSheetByIndex(0)->setCellValue('G5', $date);

                // set Item
                $startRowPr = 11;
                $totalPr = 0;
                foreach ($this->payment->item as $no => $item) {
                    $event->getWriter()->getSheetByIndex(0)->setCellValue('A' . $startRowPr, $no + 1);
                    $event->getWriter()->getSheetByIndex(0)->setCellValue('B' . $startRowPr, $item->description);
                    $event->getWriter()->getSheetByIndex(0)->setCellValue('D' . $startRowPr, $item->quantity);
                    $event->getWriter()->getSheetByIndex(0)->setCellValue('E' . $startRowPr, $item->unit_of_measurement);
                    $event->getWriter()->getSheetByIndex(0)->setCellValue('F' . $startRowPr, $item->estimated_unit_price);
                    $event->getWriter()->getSheetByIndex(0)->setCellValue('G' . $startRowPr, $item->amount);
                    $totalPr += $item->amount;
                    $startRowPr++;
                }

                // Total in words
                $formatter = new NumberFormatter('en', NumberFormatter::SPELLOUT);
                $event->getWriter()->getSheetByIndex(0)->setCellValue('C23', ucwords($formatter->format($totalPr)) . ' Rupiah');

                // Grand Total
                $event->getWriter()->getSheetByIndex(0)->setCellValue('G20', $totalPr);
                $event->getWriter()->getSheetByIndex(0)->setCellValue('G21', 0);
                $event->getWriter()->getSheetByIndex(0)->setCellValue('G22', $totalPr);

                /*
                    Cash Advance Request
                */

                // Set Nama
                $event->getWriter()->getSheetByIndex(1)->setCellValue('C5', $this->payment->staff->nama_staff);
                $event->getWriter()->getSheetByIndex(1)->setCellValue('F9', $this->payment->staff->nama_staff);
                // set departement
                $event->getWriter()->getSheetByIndex(1)->setCellValue('C7', $this->payment->staff->position->nama_position);
                $event->getWriter()->getSheetByIndex(1)->setCellValue('G11', $this->payment->staff->position->nama_position);
                // Set Date
                $event->getWriter()->getSheetByIndex(1)->setCellValue('G5', $date);

                // Set Item
                $startRowCar = 20;
                $totalAmountCar = 0;
                foreach ($this->payment->item as $no => $item) {
                    $event->getWriter()->getSheetByIndex(1)->setCellValue('A' . $startRowCar, $no + 1);
                    $event->getWriter()->getSheetByIndex(1)->setCellValue('B' . $startRowCar, $item->description);
                    $event->getWriter()->getSheetByIndex(1)->setCellValue('D' . $startRowCar, $item->references);
                    $event->getWriter()->getSheetByIndex(1)->setCellValue('E' . $startRowCar, $item->budget_available);
                    $event->getWriter()->getSheetByIndex(1)->setCellValue('F' . $startRowCar, $item->amount);
                    $event->getWriter()->getSheetByIndex(1)->setCellValue('G' . $startRowCar, $item->project);
                    $event->getWriter()->getSheetByIndex(1)->setCellValue('H' . $startRowCar, $item->account_code);
                    $startRowCar++;
                    $totalAmountCar += $item->amount;
                }

                // Set Total
                $event->getWriter()->getSheetByIndex(1)->setCellValue('E31', $totalAmountCar);
                $event->getWriter()->getSheetByIndex(1)->setCellValue('C14', $totalAmountCar);

                // Set Approver
                foreach ($this->payment->acceptance as $accept) {
                    if ($accept->staff->position->id_subposition == 1) {
                        $event->getWriter()->getSheetByIndex(1)->setCellValue('F14', $accept->staff->nama_staff);
                        $event->getWriter()->getSheetByIndex(1)->setCellValue('G16', $accept->staff->position->nama_position);
                    }
                }
            }
        ];
    }


}
