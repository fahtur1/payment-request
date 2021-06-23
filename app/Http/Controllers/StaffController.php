<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nama_staff' => ['required'],
            'email_staff' => ['required', 'email:rfc,dns', 'unique:App\Models\Staff,email_staff'],
            'tanggal_lahir' => ['required'],
            'tanggal_masuk' => ['required'],
            'id_position' => ['required', 'not_in:0']
        ]);

        $tanggal_lahir = $request->post('tanggal_lahir');
        $tanggal_masuk = $request->post('tanggal_masuk');

        $data = [
            'id_staff' => uniqid('staff-akf-'),
            'nama_staff' => $request->post('nama_staff'),
            'email_staff' => $request->post('email_staff'),
            'tanggal_lahir' => date('d-m-Y', strtotime($tanggal_lahir)),
            'tanggal_masuk' => date('d-m-Y', strtotime($tanggal_masuk)),
            'password' => Hash::make('akfindonesia123'),
            'id_position' => $request->post('id_position'),
            'id_role' => 2
        ];

        $staff = Staff::create($data);

        if ($staff) {
            return redirect()->route('admin.staff')
                ->with('status', 'Staff has been created !')
                ->with('class', 'success');
        } else {
            return redirect()->route('admin.staff')
                ->with('status', 'Failed to create Staff !')
                ->with('class', 'danger');
        }
    }

    public function edit(Request $request, Staff $staff)
    {
        $staff->id_position = $request->post('id_position');

        if ($staff->save()) {
            return redirect()->route('admin.staff')
                ->with('status', 'Staff has been updated !')
                ->with('class', 'success');
        } else {
            return redirect()->route('admin.staff')
                ->with('status', 'Failed to update Staff !')
                ->with('class', 'danger');
        }
    }

    public function delete($id)
    {
        $staff = Staff::findOrFail(decrypt($id))->delete();

        if ($staff) {
            return redirect()->route('admin.staff')
                ->with('status', 'Staff has been deleted !')
                ->with('class', 'success');;
        } else {
            return redirect()->route('admin.staff')
                ->with('status', 'Failed to delete Staff !')
                ->with('class', 'danger');
        }
    }
}
