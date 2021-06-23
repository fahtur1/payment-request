<?php

namespace App\Imports;

use App\Models\Staff;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return Staff
     */
    public function model(array $row)
    {
        return new Staff([
            'id_staff' => 'mangstap',
            'nama_staff' => 'Patur',
            'email_staff' => 'fatur@gmail.com',
            'tanggal_masuk' => '22-02-2021' ,
            'tanggal_lahir' => '21-03-2021',
            'password' => 'stikombaliyahut',
            'id_role' => 1,
            'id_position' => 1
        ]);
    }
}
