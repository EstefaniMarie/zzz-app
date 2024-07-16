<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Consultas;
use App\Models\Citas;
use Faker\Generator as Faker;

class ConsultasFactory extends Factory
{
    protected $model = Consultas::class;

    public function definition()
    {
        $faker = \Faker\Factory::create();
        $citas = Citas::pluck("id")->all();

        // Generar una fecha aleatoria entre hoy y dentro de 3 meses
        $startDate = $faker->dateTimeBetween('now', '+3 months')->format('Y-m-d');

        // Elegir una hora aleatoria entre 8 y 15 (representa las 16:00 en formato militar)
        $startHour = $faker->numberBetween(8, 15);

        // Formatear la hora de inicio con minutos y segundos fijos
        $startTime = sprintf('%02d:00:00', $startHour);

        // Crear la fecha de inicio completa
        $startDateTime = new \DateTime("$startDate $startTime");

        // Calcular la fecha de fin (1 hora después de startDateTime)
        $endDateTime = clone $startDateTime;
        $endDateTime->add(new \DateInterval('PT1H')); // Agregar 1 hora

        return [
            'start_date' => $startDateTime,
            'end_date' => $endDateTime,
            'idCita' => $faker->unique()->randomElement($citas),
        ];
    }
}
