<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function createPosition(Request $request)
    {
        $data = [
            'nama_position' => $request->post('nama_position'),
            'id_subposition' => $request->post('id_subposition')
        ];

        $position = Position::create($data);

        if ($position) {
            return redirect()->route('admin.position')
                ->with('status', 'Position has been created!')
                ->with('class', 'success');
        } else {
            return redirect()->route('admin.position')
                ->with('status', 'Failed to create Position !')
                ->with('class', 'danger');
        }
    }

    public function editPosition(Request $request, Position $position)
    {
        $position->nama_position = $request->post('nama_position');
        $position->id_subposition = $request->post('id_subposition');

        if ($position->save()) {
            return redirect()->route('admin.position')
                ->with('status', 'Position has been updated!')
                ->with('class', 'success');
        } else {
            return redirect()->route('admin.position')
                ->with('status', 'Failed to update Position !')
                ->with('class', 'danger');
        }
    }

    public function deletePosition($id)
    {
        $position = Position::findOrFail(decrypt($id));

        if ($position->delete()) {
            return redirect()->route('admin.position')
                ->with('status', 'Position has been deleted!')
                ->with('class', 'success');
        } else {
            return redirect()->route('admin.position')
                ->with('status', 'Failed to delete Position !')
                ->with('class', 'danger');
        }
    }
}
