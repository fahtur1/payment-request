<?php

namespace App\Http\Controllers;

use App\Models\PaymentRequest;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function showHome()
    {
        $totalRequest = PaymentRequest::where('id_staff', auth()->user()->id_staff)
            ->get()
            ->count();

        $requestDone = PaymentRequest::where('status', 'Done')
            ->where('id_staff', auth()->user()->id_staff)
            ->get()
            ->count();

        $pendingRequest = PaymentRequest::where('id_staff', auth()->user()->id_staff)
            ->where('status', 'Requested')
            ->orWhere('status', 'Settlement')
            ->get()
            ->count();

        $declinedRequest = PaymentRequest::where('status', 'Rejected')
            ->Where('status', 'Rejected')
            ->where('id_staff', auth()->user()->id_staff)
            ->get()
            ->count();

        return view('staff.home')
            ->with(['title' => 'Home'])
            ->with(['total_request' => $totalRequest])
            ->with(['pending_request' => $pendingRequest])
            ->with(['declined_request' => $declinedRequest])
            ->with(['request_done' => $requestDone]);
    }

    public function showMyRequest()
    {
        $myrequest = PaymentRequest::where('id_staff', auth()->user()->id_staff)
            ->orderByDesc('tanggal_pengajuan')
            ->get();

        return view('staff.payment_request.myrequest')
            ->with(['title' => 'My Request'])
            ->with(['myrequests' => $myrequest]);
    }

    public function showMyRequestById(PaymentRequest $id)
    {
        return view('staff.payment_request.detail_request')
            ->with(['title' => 'Detail Request'])
            ->with(['myrequest' => $id]);
    }

    public function showSettlement()
    {
        $settlement = PaymentRequest::where('id_staff', auth()->user()->id_staff)
            ->where('status', 'Settlement')
            ->orWhere('status', 'Done')
            ->orderByDesc('tanggal_pengajuan')
            ->get();

        return view('staff.settlement.settlement')
            ->with(['title' => 'Settlement'])
            ->with(['settlements' => $settlement]);
    }

    public function showUploadSettlement(PaymentRequest $id)
    {
        return view('staff.settlement.upload')
            ->with(['title' => 'Upload Settlement'])
            ->with(['settlement' => $id]);
    }

    public function showAddRequest()
    {
        return view('staff.payment_request.add_request')
            ->with(['title' => 'Add Request']);
    }

    public function showAcceptance()
    {
        $acceptances = PaymentRequest::orderByDesc('tanggal_pengajuan')->get();

        return view('staff.acceptance.acceptance')
            ->with(['title' => 'Acceptance'])
            ->with(['acceptances' => $acceptances]);
    }

    public function showListDonator()
    {
        return view('staff.list_donator')
            ->with(['title' => 'List Donator']);
    }

}
