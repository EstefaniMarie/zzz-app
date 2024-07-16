<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Citas;
use App\Models\Consultas;
use Database\Factories\ConsultasFactory;

class ConsultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $citas = Citas::all();
        foreach ($citas as $cita) {
            Consultas::factory()->create([
                'idCita' => $cita->id,
            ]);
        }
    }
}
