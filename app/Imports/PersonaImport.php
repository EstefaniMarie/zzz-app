<?php

namespace App\Imports;

use App\Models\Personas;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class PersonaImport implements ToModel, WithChunkReading, WithBatchInserts
{

    public function model(array $row)
    {
        // dd($row);
        // Personas::updateOrCreate(['id' => $row['id'],
        //     [
        //         'cedula' => $row['cedula'],
        //         'nombres' => $row['nombres'],
        //         'apellidos' => $row['apellidos'],
        //         'fecha_nacimiento' => $row['fecha_nacimiento'],
        //         'idGenero' => $row['idGenero'],
        //         'crated_at' => $row['created_at'],
        //         'updated_at' => $row['updated_at']
        //     ]
        // ]);
        // Verificar si la persona existe
        $persona = Personas::where('email', $row['email'])->first();

        if ($persona) {
            // Actualizar los datos de la persona existente
            $persona->nombre = $row['nombre'];
            $persona->apellido = $row['apellido'];
            $persona->save();
        } else {
            // Crear un nuevo registro de persona
            return new  Personas([
                'cedula' => $row['cedula'],
                'nombres' => $row['nombres'],
                'apellidos' => $row['apellidos'],
                'fecha_nacimiento' => $row['fecha_nacimiento'],
                'idGenero' => $row['idGenero'],
                'crated_at' => $row['created_at'],
                'updated_at' => $row['updated_at']
            ]);
        }
    }

    public function batchSize(): int {
        return 4000;
    }

    public function chunckSize(): int {
        return 4000;
    }
}
