<?php

namespace App\Imports;

use App\Models\Personas;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PersonaImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        Personas::updateOrCreate(['id' => $row['id']],
            [
                'image' => $row['image'],
                'cedula' => $row['cedula'],
                'nombres' => $row['nombres'],
                'apellidos' => $row['apellidos'],
                'fecha_nacimiento' => Carbon::parse($row['fecha_nacimiento'])->format('Y-m-d'),
                'numero_telefono' => $row['numero_telefono'],
                'idGenero' => $row['idgenero'],
            ]
        );
    }

}
