<?php

namespace App\Http\Controllers;

use App\Models\ListItem;
use App\Models\PaymentRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RequestController extends Controller
{
    public function addRequest(Request $request)
    {
        $payment = PaymentRequest::create([
            'id_request' => uniqid('request-'),
            'id_staff' => auth()->user()->id_staff,
            'tanggal_pengajuan' => date('d-M-Y H:i:s'),
            'status' => 'Requested'
        ]);

        if ($payment) {
            $status = false;
            foreach ($request->get('data') as $data) {

                $item = ListItem::create([
                    'id_item' => uniqid('item-'),
                    'description' => $data[1],
                    'references' => $data[2],
                    'budget_available' => $data[3],
                    'amount' => $data[4],
                    'quantity' => $data[5],
                    'unit_of_measurement' => $data[6],
                    'estimated_unit_price' => $data[7],
                    'project' => $data[8],
                    'account_code' => $data[9],
                    'id_request' => $payment->id_request
                ]);

                $status = (bool)$item;
            }

            if ($status) {
                return response()->json([
                    'message' => 'Request has been send !'
                ], Response::HTTP_CREATED);
            } else {
                return response()->json([
                    'message' => 'Failed to make a request'
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json([
                'message' => 'Failed to make a request'
            ], Response::HTTP_BAD_REQUEST);
        }

    }
}
