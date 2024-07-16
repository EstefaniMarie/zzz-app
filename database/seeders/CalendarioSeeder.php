<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Calendario;

class CalendarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $calendarios = [
            [
                'nombre' => 'Cita #1',
                'start_date' => '2024-10-15 08:00',
                'end_date' => '2024-10-15 09:00'
            ],
            [
                'nombre' => 'Cita #2',
                'start_date' => '2024-10-19 10:00',
                'end_date' => '2024-10-19 11:00'
            ],
            [
                'nombre' => 'Cita #3',
                'start_date' => '2024-10-21 15:00',
                'end_date' => '2024-10-21 16:00'
            ],
            [
                'nombre' => 'Cita #4',
                'start_date' => '2024-10-22 09:00',
                'end_date' => '2024-10-22 10:00'
            ],
        ];

        foreach ($calendarios as $calendario)
        {
            Calendario::create($calendario);
        }
    }
}
