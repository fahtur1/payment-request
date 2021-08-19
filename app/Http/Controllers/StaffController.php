<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    public function editStaff(Request $request)
    {
        $staff = auth()->user();

        $checkbox = $request->post('checkboxPassword');
        $oldPassword = $request->post('old_password');
        $newPassword = $request->post('new_password');

        if ($checkbox == 'on') {
            $request->validate([
                'old_password' => ['required', 'min:6'],
                'new_password' => ['required', 'min:6']
            ]);

            if ($this->checkOldPassword($oldPassword)) {
                $staff->password = Hash::make($newPassword);
            } else {
                return redirect()
                    ->back()
                    ->with('message', 'Old Password is wrong!')
                    ->with('class', 'danger');
            }
        }

        $staff->nama_staff = $request->post('nama_staff');
        $staff->tanggal_lahir = date('d-m-Y', strtotime($request->post('tanggal_lahir')));

        if ($staff->save()) {
            return redirect()->route('staff.profile')
                ->with('message', 'Staff has been updated!')
                ->with('class', 'success');
        } else {
            return redirect()->route('staff.profile')
                ->with('message', 'Failed to update staff!')
                ->with('class', 'danger');
        }
    }

    public function edit(Request $request, $id)
    {
        $staff = Staff::find(decrypt($id));

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
        $staff = Staff::findOrFail(decrypt($id));
        $staff->is_active = '0';

        if ($staff->save()) {
            return redirect()->route('admin.staff')
                ->with('status', 'Staff has been deleted !')
                ->with('class', 'success');;
        } else {
            return redirect()->route('admin.staff')
                ->with('status', 'Failed to delete Staff !')
                ->with('class', 'danger');
        }
    }

    public function checkOldPassword($oldPassword)
    {
        return Hash::check($oldPassword, auth()->user()->password);
    }
}
