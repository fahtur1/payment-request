<?php

namespace App\Http\Controllers;

use App\Models\PaymentRequest;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function showHome()
    {
        $totalRequest = PaymentRequest::all()->count();
        $declinedRequest = PaymentRequest::where('status', 'Rejected')->get()->count();
        $requestDone = PaymentRequest::where('status', 'Done')->get()->count();
        $pendingRequest = PaymentRequest::where('status', 'Settlement')
            ->orWhere('status', 'Requested')
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
        $idStaff = auth()->user()->id_staff;

        $settlement = PaymentRequest::where([
            ['id_staff', $idStaff],
            ['status', 'Done']
        ])->orWhere([
            ['id_staff', $idStaff],
            ['status', 'Settlement']
        ])->orderByDesc('tanggal_pengajuan')
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

    public function showProfile()
    {
        return view('staff.profile.profile')
            ->with(['title' => 'Profile']);
    }

    public function showEditProfile()
    {
        return view('staff.profile.edit_profile')
            ->with(['title' => 'Edit Profile']);
    }
}
