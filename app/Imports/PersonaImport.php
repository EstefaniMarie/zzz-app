<?php

namespace App\Imports;

use App\Models\Personas;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PersonaImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        Personas::updateOrCreate(['id' => $row['id']],
            [
                'cedula' => $row['cedula'],
                'nombres' => $row['nombres'],
                'apellidos' => $row['apellidos'],
                'fecha_nacimiento' => $row['fecha_nacimiento'],
                'idGenero' => $row['idgenero'],
                'crated_at' => $row['created_at'],
                'updated_at' => $row['updated_at']
            ]
        );
        
    }

}
