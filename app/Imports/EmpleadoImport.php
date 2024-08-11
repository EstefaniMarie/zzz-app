<?php

namespace App\Imports;

use App\Models\Empleados;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmpleadoImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        Empleados::updateOrCreate(['id' => $row['id']],
            [
                'idPacientes' => $row['idpacientes'],
                'nombre_unidad' => $row['nombre_unidad'],
                'codigoTrabajador' => $row['codigotrabajador'],
                'estatus' => $row['estatus']
            ]
        );
    }
}
