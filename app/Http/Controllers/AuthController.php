<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function postLogin(Request $request)
    {
        $login = Auth::attempt([
            'email_staff' => $request->post('email_staff'),
            'password' => $request->post('password')
        ]);

        if ($login) {
            if (auth()->user()->role->id_role == 1) {
                return redirect()->route('admin.home');
            } else if (auth()->user()->role->id_role == 2) {
                return redirect()->route('staff.home');
            }
        } else {
            return redirect()->route('auth.login')
                ->with('status', 'Email or Password are wrong!')
                ->with('class', 'danger');
        }
    }

    public function postRegister(Request $request)
    {
        $request->validate([
            'nama_staff' => ['required'],
            'email_staff' => ['required', 'email:rfc', 'unique:App\Models\Staff,email_staff'],
            'password' => ['required', 'same:confirm_password', 'min:6']
        ]);

        $data = [
            'id_staff' => uniqid('staff-akf-'),
            'nama_staff' => $request->post('nama_staff'),
            'email_staff' => $request->post('email_staff'),
            'tanggal_lahir' => date('d-m-Y'),
            'tanggal_masuk' => date('d-m-Y'),
            'password' => Hash::make($request->post('password')),
            'id_role' => 2,
            'id_position' => 1
        ];

        $staff = Staff::create($data);

        if ($staff) {
            return redirect()->route('auth.login')
                ->with('status', 'User has been created !')
                ->with('class', 'success');
        } else {
            return redirect()->route('auth.login')
                ->with('status', 'Failed to create user !')
                ->with('class', 'danger');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

}
