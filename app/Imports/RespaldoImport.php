<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use App\Models\Personas;
use App\Models\Empleados;
use App\Models\Pacientes;
use App\Models\Medicos;

class RespaldoImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        // dd($collection);
        $header = true;
        $count = 0;
        foreach($collection as $row){
            if($header && $count <=1){
                $count++;
                continue;
            } else {
                $header = false;
            }
            $rowArray = str_getcsv($row[0]);
            $tableName = $rowArray[0];
            $values = array_slice($rowArray, 0);

            switch ($tableName) {
                case 'Personas':
                    Personas::updateOrCreate(['id' => $values[0]],
                    [
                        'cedula' => $values[1],
                        'nombres' => $values[2],
                        'apellidos' => $values[3],
                        'fecha_nacimiento' => $values[4],
                        'numero_telefono' => $values[5],
                        'idGenero' => $values[6]
                    ]);
                    break;
                case 'Pacientes':
                    Pacientes::updateOrCreate(['id' => $values[0]],
                    [
                        'idPersona' => $values[1]
                    ]);
                    break;
                case 'Empleados':
                    Empleados::updateOrCreate(['id' => $values[0]],
                    [
                        'idPacientes' => $values[1],
                        'nombre_unidad' => $values[2],
                        'codigoTrabajador' => $values[3]
                    ]);
                    break;
                case 'Medicos':
                    Medicos::updateOrCreate(['id' => $values[0]],
                    [
                        'idUsuario' => $values[1],
                        'colegiatura' => $values[2],
                        'diasDisponibles' => $values[3],
                        'horasDisponibles' => $values[4]
                    ]);
                    break;
            }
        }
    }
}

