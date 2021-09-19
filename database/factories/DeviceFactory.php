<?php

namespace Database\Factories;

use App\Models\Device;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeviceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Device::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'asset_tag' => $this->faker->unique()->numberBetween($min = 1000, $max = 9000),
            'serial_number' => $this->faker->unique()->numberBetween($min = 1000, $max = 9000),
        ];
    }
}
// $table->primary('asset_tag');
// $table->string('asset_tag')->unique();
// $table->foreignId('model_id')->nullable();
// $table->foreignId('building_id')->nullable();
// $table->foreignId('room_id')->nullable();
// $table->string('serial_number')->unique()->nullable();
// $table->string('mac_address')->unique()->nullable();
// $table->text('notes')->nullable();
// $table->timestamps();
