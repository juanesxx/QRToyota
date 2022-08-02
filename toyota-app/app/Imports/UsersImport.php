<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\{ToModel};

class UsersImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {
        if(!empty($row[0])){
        return User::create([
           'name'     => $row[0],
           'email'    => $row[1], 
           'password' => Hash::make($row[2]),
        ])->assignRole('rol2');
        }

    }
}