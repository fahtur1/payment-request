<?php

namespace App\Http\Controllers;

use App\Models\PaymentRequest;
use Illuminate\Http\Request;

class SettlementController extends Controller
{
    public function updateSettlement(Request $request, PaymentRequest $settlement)
    {
        $statusFile = false;
        $statusSettle = false;

        $statusFile = false;
        $statusSettle = false;

        foreach ($settlement->item as $item) {
            $name = uniqid('settlement-');
            $keyFile = 'img-' . $item->id_item;
            $keyAmountSettle = 'settlement-' . $item->id_item;

            if ($request->hasFile($keyFile)) {
                $file = $request->file($keyFile);

                $statusFile = $file->storeAs('public/settlement/', $name . '.' . $file->extension());

                $item->settlement_amount = $request->get($keyAmountSettle);
                $item->settlement = $name . '.' . $file->extension();

                $statusSettle = $item->save();
            } else {
                return redirect()->back()
                    ->with('status', 'Input All of the Image !')
                    ->with('class', 'danger');
            }
        }

        if ($statusFile && $statusSettle) {
            $settlement->status = 'Done';
            $settlement->save();
        }

        return redirect()->route('staff.settlement')
            ->with('status', 'Change has been saved !')
            ->with('class', 'success');
    }
}
