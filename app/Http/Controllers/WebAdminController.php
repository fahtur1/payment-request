<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Staff;

class WebAdminController extends Controller
{
    public function showHome()
    {
        $totalStaff = Staff::where('id_role', 2)->count();
        $totalPosition = Position::all()->count();

        return view('admin.home')
            ->with(['title' => 'Home'])
            ->with(['total_staff' => $totalStaff])
            ->with(['total_position' => $totalPosition]);
    }

    public function showStaff()
    {
        $staff = Staff::where('id_role', 2)->get();

        return view('admin.staff')
            ->with(['title' => 'Staff'])
            ->with(['staffs' => $staff]);
    }

    public function addStaff()
    {
        $position = Position::all();

        return view('admin.add_staff')
            ->with(['title' => 'Add Staff'])
            ->with(['positions' => $position]);
    }

    public function showListPosition()
    {
        $position = Position::all();

        return view('admin.position')
            ->with(['title' => 'Position'])
            ->with(['positions' => $position]);
    }

    public function showAddPosition()
    {
        $positions = Position::all();

        return view('admin.add_position')
            ->with(['title' => 'Add Position'])
            ->with(['positions' => $positions]);
    }

    public function showEditPosition($id)
    {
        $positions = Position::all();
        $position = Position::find(decrypt($id));

        return view('admin.edit_position')
            ->with(['title' => 'Edit Position'])
            ->with(['position' => $position])
            ->with(['positions' => $positions]);
    }

    public function showEditStaff($id)
    {
        $staff = Staff::find(decrypt($id))->first();
        $position = Position::all();

        return view('admin.edit_staff')
            ->with(['title' => 'Edit Staff'])
            ->with(['positions' => $position])
            ->with(['staff' => $staff]);
    }
}
