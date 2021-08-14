<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Ticket;
use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->sentence(),
            'ticket_id' => Ticket::factory(),
            'author_id' => User::factory()
        ];
    }
}
