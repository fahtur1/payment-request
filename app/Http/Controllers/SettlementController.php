<?php

namespace App\Http\Controllers;

use App\Models\PaymentRequest;
use Illuminate\Http\Request;

class SettlementController extends Controller
{
    public function updateSettlement(Request $request,PaymentRequest $id)
    {
        $statusFile = false;
        $statusSettle = false;

        foreach ($id->item as $item) {
            $name = uniqid('settlement-');
            $keyFile = 'img-' . $item->id_item;
            $keyAmountSettle = 'settlement-' . $item->id_item;

            if ($request->hasFile($keyFile)) {
                $file = $request->file($keyFile);

                $statusFile = $file->storeAs('/', $name . '.' . $file->extension(), 'settlement');

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
            $id->status = 'Done';
            $id->save();
        }

        return redirect()->route('staff.settlement')
            ->with('status', 'Change has been saved !')
            ->with('class', 'success');
    }
}
