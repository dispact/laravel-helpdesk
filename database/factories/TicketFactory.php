<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\Building;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(2),
            'building_id' => Building::factory(),
            'author_id' => User::factory(),
            'category_id' => Category::factory(),
            'status_id' => Status::factory()
        ];
    }
}
