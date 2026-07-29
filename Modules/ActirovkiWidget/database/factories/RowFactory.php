<?php

namespace Modules\ActirovkiWidget\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\ActirovkiWidget\Models\Row;

class RowFactory extends Factory
{
    protected $model = Row::class;

    public function definition(): array
    {
        $created = Carbon::instance($this->faker->dateTimeBetween('-3 year', 'now'));
        $isCancelled = $this->faker->boolean(10);

        return [
            'city_id' => $this->faker->numberBetween(28, 136),
            'weather_id' => $this->faker->numberBetween(1, 5),
            'weather_range_id' => $this->faker->numberBetween(1, 400),
            'cancel_user_id' => $isCancelled
                ? $this->faker->numberBetween(1, 100)
                : null,
            'school_shift' => $this->faker->numberBetween(1, 2),
            'created_at' => $created,
            'cancel_at' => $isCancelled
                ? $this->faker->dateTimeBetween($created, 'now')
                : null,
            'send_at' => $created->copy()->addMinutes($this->faker->numberBetween(0, 10)),
        ];
    }
}
