<?php

namespace App\Imports;

use App\Models\Empleados;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class MedicoImport implements ToModel
{

    public function model(array $row)
    {
        Empleados::updateOrCreate([$row['id'],
            [
                ''
            ]
        ])
    }
}
