<?php

namespace Modules\ActirovkiWidget\Database\Factories;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\ActirovkiWidget\Models\Weather;

class WeatherFactory extends Factory
{
    protected $model = Weather::class;

    public function definition(): array
    {
        $created = CarbonImmutable::instance($this->faker->dateTimeBetween('-3 year', 'now'));
        $receivedAt = CarbonImmutable::instance($this->faker->dateTimeBetween($created->subHour(), $created));

        return [
            'city_id' => $this->faker->numberBetween(28, 136),
            'temperature' => $this->faker->randomFloat(1, -50, -24),
            'wind' => $this->faker->randomFloat(1, 0, 20),
            'created_at' => $created,
            'received_at' => $receivedAt,
        ];
    }
}
