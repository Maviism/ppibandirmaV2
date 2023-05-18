<?php

namespace Database\Factories\Event;

use App\Models\Event\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
use Carbon\Carbon;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EventFactory extends Factory
{
    protected $model = Event::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = Carbon::parse('2022-01-01');
        $endDate = Carbon::parse('2023-12-31');
        $faker = Faker::create();
        $datetime = $faker->dateTimeBetween($startDate, $endDate);
        $types = ['Public', 'Internal', 'Tömer'];
        return [
            'title' => $faker->sentence(),
            'venue' => $faker->company(),
            'datetime' => $formattedDatetime = $datetime->format('Y-m-d H:i'),
            'type' => $faker->randomElement($types),
            'total_participants' => $faker->numberBetween(30, 201),
            'description' => $faker->paragraph(),
        ];
    }
}
