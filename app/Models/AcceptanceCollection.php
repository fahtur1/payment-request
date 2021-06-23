<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;

class AcceptanceCollection extends Collection
{
    public function hasPermission($idStaff, $idRequest)
    {
        $permission = true;

        $staff = Staff::find($idStaff);

        foreach (Acceptance::lazy() as $accept) {
            if ($accept->id_request == $idRequest) {
                if ($accept->staff->id_staff == $staff->id_staff) {
                    $permission = false;
                }
                if ($staff->position->subposition->allowed_to_accept_request == false) {
                    $permission = false;
                }
                if ($accept->staff->position->subposition->id_subposition == $staff->position->subposition->id_subposition) {
                    $permission = false;
                }
            }
        }

        return $permission;
    }
}
