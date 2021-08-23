<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $building = \App\Models\Building::factory()->create([
            'name' => 'HMS'
        ]);
        \App\Models\User::factory()->create([
            'email' => 'admin@admin.com',
            'staff' => true,
            'building_id' => $building->id
        ]);
        \App\Models\User::factory(2)->create(['building_id' => $building->id]);
        \App\Models\Category::factory()->create([
            'name' => 'Hardware'
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'Software'
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'Wireless'
        ]);
        \App\Models\Status::factory()->create([
            'name' => 'Open',
            'color' => '0'
        ]);
        \App\Models\Status::factory()->create([
            'name' => 'Pending',
            'color' => '1'
        ]);
        \App\Models\Status::factory()->create([
            'name' => 'Closed',
            'color' => '2'
        ]);
        $staff = \App\Models\Staff::factory()->create([
            'user_id' => '1',
        ]);
        $staff->categories()->attach(['1','2','3']);
        $staff->buildings()->attach(['1']);
        \App\Models\Staff::factory()->create([
            'user_id' => '2',
        ]);
        $ticket = \App\Models\Ticket::factory(5)->create([
            'building_id' => $building->id,
            'category_id' => '1',
            'status_id' => '1'
        ]);
        foreach($ticket as $ticket)
            $ticket->staff()->attach($staff->id);
        $charger = \App\Models\DeviceModel::create([
            'name' => 'USB-C Power Supply',
            'type' => 11,
            'manufacturer' => 9
        ]);
        $laptop = \App\Models\DeviceModel::create([
            'name' => 'Dell Latitude 3390',
            'type' => 4,
            'manufacturer' => 9
        ]);
        \App\Models\Device::create([
            'asset_tag' => 'PS-0001',
            'model_id' => $charger->id,
            'building_id' => $building->id
        ]);
        \App\Models\Device::create([
            'asset_tag' => '2LPTBF2',
            'model_id' => $laptop->id,
            'building_id' => $building->id,
            'serial_number' => '2LPTBF2'
        ]);
    }
}
