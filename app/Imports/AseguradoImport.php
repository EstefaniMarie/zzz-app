<?php

namespace App\Imports;

use App\Models\OtrosAsegurados;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AseguradoImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // dd($row['updated_at']);
        OtrosAsegurados::updateOrCreate(['id' => $row['id']],
            [
                'idPacientes' => $row['idpacientes'],
                'estatus' => $row['estatus'],
            ]
        );
    }
}
