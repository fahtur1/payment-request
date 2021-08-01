<?php

namespace App\Exports;

use App\Models\PaymentRequest;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Files\LocalTemporaryFile;
use \NumberFormatter;

class PaymentExportWithChange implements WithEvents
{
    public function __construct(PaymentRequest $payment, $change)
    {
        $this->payment = $payment;
        $this->change = $change;
    }

    public function registerEvents(): array
    {
        return [
            BeforeWriting::class => function (BeforeWriting $event) {
                $event->writer->reopen(new LocalTemporaryFile(Storage::path('Form_With_Change.xlsx')), Excel::XLSX);

                $dateRaw = date_create($this->payment->tanggal_pengajuan);
                $requestDate = date_format($dateRaw, 'd-m-Y');

                $dateRawAccepted = date_create($this->payment->updated_at);
                $acceptSettlement = date_format($dateRawAccepted, 'd-m-Y');

                /*
                    Payment Request
                */

                // set Nama
                $event->getWriter()->getSheetByIndex(0)->setCellValue('C5', $this->payment->staff->nama_staff);
                $event->getWriter()->getSheetByIndex(0)->setCellValue('A30', $this->payment->staff->nama_staff);

                // set Department
                $event->getWriter()->getSheetByIndex(0)->setCellValue('C6', $this->payment->staff->position->nama_position);

                // set Date
                $event->getWriter()->getSheetByIndex(0)->setCellValue('G5', $requestDate);

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
                $event->getWriter()->getSheetByIndex(0)->setCellValue('C24', ucwords($formatter->format($totalPr)) . ' Rupiah');

                // Grand Total
                $event->getWriter()->getSheetByIndex(0)->setCellValue('G21', $totalPr);
                $event->getWriter()->getSheetByIndex(0)->setCellValue('G22', 0);
                $event->getWriter()->getSheetByIndex(0)->setCellValue('G23', $totalPr);

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
                $event->getWriter()->getSheetByIndex(1)->setCellValue('G5', $requestDate);

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
                $event->getWriter()->getSheetByIndex(1)->setCellValue('E30', $totalAmountCar);
                $event->getWriter()->getSheetByIndex(1)->setCellValue('C14', $totalAmountCar);

                // Set Approver
                foreach ($this->payment->acceptance as $accept) {
                    if ($accept->staff->position->id_subposition == 1) {
                        $event->getWriter()->getSheetByIndex(1)->setCellValue('F14', $accept->staff->nama_staff);
                        $event->getWriter()->getSheetByIndex(1)->setCellValue('G16', $accept->staff->position->nama_position);
                    }
                }

                /*
                    Cash Payment Voucher
                */

                // Set Date
                $event->getWriter()->getSheetByIndex(2)->setCellValue('H5', $requestDate);
                $event->getWriter()->getSheetByIndex(2)->setCellValue('G28', $acceptSettlement);

                // Set Name
                $event->getWriter()->getSheetByIndex(2)->setCellValue('D8', $this->payment->staff->nama_staff);
                $event->getWriter()->getSheetByIndex(2)->setCellValue('G26', $this->payment->staff->nama_staff);
                $event->getWriter()->getSheetByIndex(2)->setCellValue('A31', $this->payment->staff->nama_staff);

                // Set Position
                $event->getWriter()->getSheetByIndex(2)->setCellValue('B33', $this->payment->staff->position->nama_position);
                $event->getWriter()->getSheetByIndex(2)->setCellValue('B34', $requestDate);

                // Set Item
                $startRowCashPV = 13;
                $totalAmountCashPV = 0;
                foreach ($this->payment->item as $no => $item) {
                    $event->getWriter()->getSheetByIndex(2)->setCellValue('A' . $startRowCashPV, $no + 1);
                    $event->getWriter()->getSheetByIndex(2)->setCellValue('B' . $startRowCashPV, $item->description);
                    $event->getWriter()->getSheetByIndex(2)->setCellValue('D' . $startRowCashPV, $item->references);
                    $event->getWriter()->getSheetByIndex(2)->setCellValue('E' . $startRowCashPV, $item->budget_available);
                    $event->getWriter()->getSheetByIndex(2)->setCellValue('G' . $startRowCashPV, $item->amount);
                    $event->getWriter()->getSheetByIndex(2)->setCellValue('H' . $startRowCashPV, $item->project);
                    $event->getWriter()->getSheetByIndex(2)->setCellValue('J' . $startRowCashPV, $item->account_code);
                    $startRowCashPV++;
                    $totalAmountCashPV += $item->amount;
                }

                // Set Total
                $event->getWriter()->getSheetByIndex(2)->setCellValue('G23', $totalAmountCashPV);

                // In Word
                $event->getWriter()->getSheetByIndex(2)->setCellValue('C24', ucwords($formatter->format($totalAmountCashPV)) . ' Rupiah');

                // Set Approver
                foreach ($this->payment->acceptance as $accept) {
                    $dateAcceptRaw = date_create($accept->created_at);
                    $acceptedDate = date_format($dateAcceptRaw, 'd-m-Y');

                    switch ($accept->staff->position->id_subposition) {
                        case 1:
                            $event->getWriter()->getSheetByIndex(2)->setCellValue('E37', $accept->staff->nama_staff);
                            $event->getWriter()->getSheetByIndex(2)->setCellValue('F39', $accept->staff->position->nama_position);
                            $event->getWriter()->getSheetByIndex(2)->setCellValue('F40', $acceptedDate);
                            break;
                        case 2:
                            $event->getWriter()->getSheetByIndex(2)->setCellValue('H31', $accept->staff->nama_staff);
                            $event->getWriter()->getSheetByIndex(2)->setCellValue('I33', $accept->staff->position->nama_position);
                            $event->getWriter()->getSheetByIndex(2)->setCellValue('I34', $acceptedDate);
                            break;
                        case 3:
                            $event->getWriter()->getSheetByIndex(2)->setCellValue('E31', $accept->staff->nama_staff);
                            $event->getWriter()->getSheetByIndex(2)->setCellValue('F33', $accept->staff->position->nama_position);
                            $event->getWriter()->getSheetByIndex(2)->setCellValue('F34', $acceptedDate);
                            break;
                    }
                }

                /*
                    Cash Advance Regulation
                */

                // Set Date
                $event->getWriter()->getSheetByIndex(3)->setCellValue('J6', $requestDate);
                $event->getWriter()->getSheetByIndex(3)->setCellValue('C39', $requestDate);
                $event->getWriter()->getSheetByIndex(3)->setCellValue('J32', $acceptSettlement);

                // Set Name
                $event->getWriter()->getSheetByIndex(3)->setCellValue('D6', $this->payment->staff->nama_staff);
                $event->getWriter()->getSheetByIndex(3)->setCellValue('J30', $this->payment->staff->nama_staff);
                $event->getWriter()->getSheetByIndex(3)->setCellValue('A37', $this->payment->staff->nama_staff);

                // Set Deparment
                $event->getWriter()->getSheetByIndex(3)->setCellValue('D7', $this->payment->staff->position->nama_position);
                $event->getWriter()->getSheetByIndex(3)->setCellValue('C38', $this->payment->staff->position->nama_position);

                // Set Item
                $startRowCashAdvRe = 15;
                $totalAmountCashAdvRe = 0;
                $grandTotalAmountCashAdvRe = 0;
                foreach ($this->payment->item as $no => $item) {
                    $event->getWriter()->getSheetByIndex(3)->setCellValue('A' . $startRowCashAdvRe, $no + 1);
                    $event->getWriter()->getSheetByIndex(3)->setCellValue('B' . $startRowCashAdvRe, $item->description);
                    $event->getWriter()->getSheetByIndex(3)->setCellValue('E' . $startRowCashAdvRe, $item->references);
                    $event->getWriter()->getSheetByIndex(3)->setCellValue('F' . $startRowCashAdvRe, $item->budget_available);
                    $event->getWriter()->getSheetByIndex(3)->setCellValue('I' . $startRowCashAdvRe, $item->settlement_amount);
                    $event->getWriter()->getSheetByIndex(3)->setCellValue('J' . $startRowCashAdvRe, $item->project);
                    $event->getWriter()->getSheetByIndex(3)->setCellValue('L' . $startRowCashAdvRe, $item->account_code);
                    $startRowCashAdvRe++;
                    $grandTotalAmountCashAdvRe += $item->settlement_amount;
                    $totalAmountCashAdvRe += $item->amount;
                }

                $change = $totalAmountCashAdvRe - $grandTotalAmountCashAdvRe;

                // Set Total
                $event->getWriter()->getSheetByIndex(3)->setCellValue('I25', $grandTotalAmountCashAdvRe);

                // Set Amount Returned
                $event->getWriter()->getSheetByIndex(3)->setCellValue('I26', $change);

                // set In word
                $event->getWriter()->getSheetByIndex(3)->setCellValue('C28', ucwords($formatter->format($grandTotalAmountCashAdvRe)) . ' Rupiah');

                // Set Approver
                foreach ($this->payment->acceptance as $accept) {
                    $dateAcceptRaw = date_create($accept->created_at);
                    $acceptedDate = date_format($dateAcceptRaw, 'd-m-Y');

                    switch ($accept->staff->position->id_subposition) {
                        case 2:
                            $event->getWriter()->getSheetByIndex(3)->setCellValue('J37', $accept->staff->nama_staff);
                            $event->getWriter()->getSheetByIndex(3)->setCellValue('K38', $accept->staff->position->nama_position);
                            $event->getWriter()->getSheetByIndex(3)->setCellValue('K39', $acceptedDate);
                            break;
                        case 3:
                            $event->getWriter()->getSheetByIndex(3)->setCellValue('F37', $accept->staff->nama_staff);
                            $event->getWriter()->getSheetByIndex(3)->setCellValue('G38', $accept->staff->position->nama_position);
                            $event->getWriter()->getSheetByIndex(3)->setCellValue('G39', $acceptedDate);
                            break;
                    }
                }

                /*
                    Cash Receipt Voucher
                */

                // Set Date
                $event->getWriter()->getSheetByIndex(4)->setCellValue('H5', $requestDate);

                // Set Name
                $event->getWriter()->getSheetByIndex(4)->setCellValue('D8', $this->payment->staff->nama_staff);
                $event->getWriter()->getSheetByIndex(4)->setCellValue('A31', $this->payment->staff->nama_staff);

                // Set Position
                $event->getWriter()->getSheetByIndex(4)->setCellValue('B33', $this->payment->staff->position->nama_position);
                $event->getWriter()->getSheetByIndex(4)->setCellValue('B34', $requestDate);

                // Set Item
                $event->getWriter()->getSheetByIndex(4)->setCellValue('B13', 'Change From this Payment Request');
                $event->getWriter()->getSheetByIndex(4)->setCellValue('G13', $change);

                // Set Total
                $event->getWriter()->getSheetByIndex(4)->setCellValue('G23', $change);

                // In Word
                $event->getWriter()->getSheetByIndex(4)->setCellValue('C24', ucwords($formatter->format($change)) . ' Rupiah');

                foreach ($this->payment->acceptance as $accept) {
                    $dateAcceptRaw = date_create($accept->created_at);
                    $acceptedDate = date_format($dateAcceptRaw, 'd-m-Y');

                    switch ($accept->staff->position->id_subposition) {
                        case 1:
                            $event->getWriter()->getSheetByIndex(4)->setCellValue('E37', $accept->staff->nama_staff);
                            $event->getWriter()->getSheetByIndex(4)->setCellValue('F39', $accept->staff->position->nama_position);
                            $event->getWriter()->getSheetByIndex(4)->setCellValue('F40', $acceptedDate);
                            break;
                        case 2:
                            $event->getWriter()->getSheetByIndex(4)->setCellValue('H31', $accept->staff->nama_staff);
                            $event->getWriter()->getSheetByIndex(4)->setCellValue('I33', $accept->staff->position->nama_position);
                            $event->getWriter()->getSheetByIndex(4)->setCellValue('I34', $acceptedDate);
                            break;
                        case 3:
                            $event->getWriter()->getSheetByIndex(4)->setCellValue('E31', $accept->staff->nama_staff);
                            $event->getWriter()->getSheetByIndex(4)->setCellValue('F33', $accept->staff->position->nama_position);
                            $event->getWriter()->getSheetByIndex(4)->setCellValue('F34', $acceptedDate);
                            break;
                    }
                }

            }
        ];
    }


}
