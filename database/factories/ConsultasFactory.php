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

        $startDate = $faker->dateTimeBetween('now', '+3 months')->format('Y-m-d');
        while (in_array((new \DateTime($startDate))->format('N'), [6, 7])) {
            $startDate = $faker->dateTimeBetween('now', '+3 months')->format('Y-m-d');
        }

        $startHour = $faker->numberBetween(8, 15);
        $startTime = sprintf('%02d:00:00', $startHour);
        $startDateTime = new \DateTime("$startDate $startTime");
        $endDateTime = clone $startDateTime;
        $endDateTime->add(new \DateInterval('PT1H'));

        return [
            'start_date' => $startDateTime,
            'end_date' => $endDateTime,
            'idCita' => $faker->unique()->randomElement($citas),
        ];
    }
}
