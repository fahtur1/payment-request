<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettlementController extends Controller
{
    public function updateSettlement(Request $request, $id)
    {
        $settlement = decrypt($id);

        foreach ($settlement->item as $item) {
            $name = uniqid('settlement-');

            $file = $request->file('img-' . $item->id_item);
            $file->storeAs('settlement/', $name . '.' . $file->extension());

            $item->settlement = $name;
            $item->save();
        }

        $settlement->status = 'Done';
        $settlement->save();

        return redirect()->route('staff.settlement')
            ->with('status', 'Change has been saved !')
            ->with('class', 'success');
    }
}
