<?php

namespace App\Imports;

use App\Models\Empleados;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MedicoImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        dd($row);
        Empleados::updateOrCreate(['id' => $row['id'],
            [
                'idUsuario' => $row['idUsuario'],
                'estatus' => $row['estatus'],
                'colegiatura' => $row['colegiatura'],
                'diasDisponibles' => $row['diasDisponibles'],
                'horasDisponibles' => $row['horasDisponibles'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at']
            ]
        ]);
    }
}
