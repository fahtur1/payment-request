<?php

namespace App\Http\Controllers;

use App\Models\Acceptance;
use App\Models\PaymentRequest;
use Illuminate\Http\Request;

class AcceptanceController extends Controller
{
    public function acceptRequest($id)
    {
        $payment = PaymentRequest::find(decrypt($id))->first();

        $accpt = Acceptance::create([
            'id_acceptance' => uniqid('accpt-'),
            'id_request' => $payment->id_request,
            'id_staff' => auth()->user()->id_staff
        ]);

        if ($accpt) {
            if ($payment->acceptance->count() == 3) {
                $payment->status = 'Settlement';

                if ($payment->save()) {
                    return redirect()->back()->with([
                        'status' => 'Request has been accepted!',
                        'class' => 'success'
                    ]);
                } else {
                    return redirect()->back()->with([
                        'status' => 'Failed to accepting request!',
                        'class' => 'danger'
                    ]);
                }
            } else {
                return redirect()->back()->with([
                    'status' => 'Request has been accepted!',
                    'class' => 'success'
                ]);
            }
        } else {
            return redirect()->back()->with([
                'status' => 'Failed to accepting request!',
                'class' => 'danger'
            ]);
        }
    }

    public function declineRequest($id)
    {
        if (PaymentRequest::where('id_request', decrypt($id))->update(['status' => 'Rejected'])) {
            return redirect()->back()->with([
                'status' => 'Request has been <strong>rejected!</strong>',
                'class' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'status' => '<strong>Failed</strong> to rejected request!',
                'class' => 'danger'
            ]);
        }
    }

}
