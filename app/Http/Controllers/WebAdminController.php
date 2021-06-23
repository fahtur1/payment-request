<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Staff;
use Illuminate\Http\Request;

class WebAdminController extends Controller
{
    public function showHome()
    {
        return view('admin.home')->with(['title' => 'Home']);
    }

    public function showStaff()
    {
        $staff = Staff::where('id_role', 2)->get();

        return view('admin.staff')->with(['title' => 'Staff', 'staffs' => $staff]);
    }

    public function addStaff()
    {
        $position = Position::all();
        return view('admin.add_staff')->with(['title' => 'Add Staff', 'positions' => $position]);
    }

    public function showListPosition()
    {
        $position = Position::all();
        return view('admin.position')->with(['title' => 'Position', 'positions' => $position]);
    }

    public function showAddPosition()
    {
        return view('admin.add_position')->with(['title' => 'Add Position']);
    }

    public function showEditPosition($id)
    {
        $position = Position::find(decrypt($id));

        return view('admin.edit_position')->with(['title' => 'Edit Position', 'position' => $position]);
    }

    public function showEditStaff($id)
    {
        $staff = Staff::find(decrypt($id))->first();
        $position = Position::all();

        return view('admin.edit_staff')->with(['title' => 'Edit Staff', 'staff' => $staff, 'positions' => $position]);
    }
}
