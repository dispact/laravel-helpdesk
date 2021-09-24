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
        $building1 = \App\Models\Building::factory()->create([
            'name' => 'North Building'
        ]);
        $building2 = \App\Models\Building::factory()->create([
            'name' => 'East Building'
        ]);
        $building3 = \App\Models\Building::factory()->create([
            'name' => 'South Building'
        ]);
        $building4 = \App\Models\Building::factory()->create([
            'name' => 'West Building'
        ]);
        $user_staff1 = \App\Models\User::factory()->create([
            'email' => 'admin@admin.com',
            'staff' => true,
            'building_id' => $building1->id
        ]);
        $user_staff2 = \App\Models\User::factory()->create([
            'email' => 'staff@staff.com',
            'staff' => true,
            'building_id' => $building3->id
        ]);
        $user_user1 = \App\Models\User::factory()->create([
            'email' => 'user@user.com',
            'building_id' => $building1->id
        ]);
        $user_user2 = \App\Models\User::factory()->create([
            'email' => 'user2@user.com',
            'building_id' => $building2->id
        ]);
        $user_user3 = \App\Models\User::factory()->create([
            'email' => 'user3@user.com',
            'building_id' => $building3->id
        ]);
        $user_user4 = \App\Models\User::factory()->create([
            'email' => 'user4@user.com',
            'building_id' => $building4->id
        ]);
        \App\Models\Category::factory()->create(['name' => 'Hardware']);
        \App\Models\Category::factory()->create(['name' => 'Software']);
        \App\Models\Category::factory()->create(['name' => 'Wireless']);
        \App\Models\Category::factory()->create(['name' => 'Email']);
        \App\Models\Category::factory()->create(['name' => 'Phone/Voicemail']);
        \App\Models\Status::factory()->create(['name' => 'Open',    'color' => '0']);
        \App\Models\Status::factory()->create(['name' => 'Pending', 'color' => '1']);
        \App\Models\Status::factory()->create(['name' => 'Closed',  'color' => '2']);
        $staff1 = \App\Models\Staff::factory()->create(['user_id' => $user_staff1->id]);
        $staff1->categories()->attach(['1','2','3']);
        $staff1->buildings()->attach(['1', '2']);
       
        $staff2 = \App\Models\Staff::factory()->create(['user_id' => $user_staff2->id]);
        $staff2->categories()->attach(['1','2','3','4', '5']);
        $staff2->buildings()->attach(['3', '4']);
        
        $tickets_1 = \App\Models\Ticket::factory(3)->create([
            'building_id' => $building1->id,
            'category_id' => '1',
            'status_id' => '1',
            'author_id' => $user_user1->id
        ]);
        $tickets_2 = \App\Models\Ticket::factory(7)->create([
            'building_id' => $building2->id,
            'category_id' => '3',
            'status_id' => '1',
            'author_id' => $user_user2->id
        ]);
        $tickets_3 = \App\Models\Ticket::factory(5)->create([
            'building_id' => $building3->id,
            'category_id' => '5',
            'status_id' => '1',
            'author_id' => $user_user3->id
        ]);
        $tickets_4 = \App\Models\Ticket::factory(2)->create([
            'building_id' => $building4->id,
            'category_id' => '4',
            'status_id' => '1',
            'author_id' => $user_user4->id
        ]);

        foreach($tickets_1 as $ticket)
            $ticket->staff()->attach($staff1->id);
        foreach($tickets_2 as $ticket)
            $ticket->staff()->attach($staff1->id);
        foreach($tickets_3 as $ticket)
            $ticket->staff()->attach($staff2->id);
        foreach($tickets_4 as $ticket)
            $ticket->staff()->attach($staff2->id);
            
        $charger = \App\Models\DeviceModel::create([
            'name' => 'USB-C Power Supply',
            'type' => 11,
            'manufacturer' => 9
        ]);
        $laptop1 = \App\Models\DeviceModel::create([
            'name' => 'Latitude 3390',
            'type' => 4,
            'manufacturer' => 9
        ]);
        $laptop2 = \App\Models\DeviceModel::create([
            'name' => 'Latitude 5310',
            'type' => 4,
            'manufacturer' => 9
        ]);
        $chromebook = \App\Models\DeviceModel::create([
            'name' => 'Chromebook 3100',
            'type' => 4,
            'manufacturer' => 9
        ]);
        $projector = \App\Models\DeviceModel::create([
            'name' => 'XJ-F101W',
            'type' => 7,
            'manufacturer' => 8
        ]);
        \App\Models\Device::factory(5)->create([
            'model_id' => $charger->id,
            'building_id' => $building1->id
        ]);
        \App\Models\Device::factory(5)->create([
            'model_id' => $charger->id,
            'building_id' => $building2->id
        ]);
        \App\Models\Device::factory(5)->create([
            'model_id' => $charger->id,
            'building_id' => $building3->id
        ]);
        \App\Models\Device::factory(2)->create([
            'model_id' => $laptop1->id,
            'building_id' => $building1->id,
        ]);
        \App\Models\Device::factory(3)->create([
            'model_id' => $laptop2->id,
            'building_id' => $building4->id,
        ]);
        \App\Models\Device::factory(7)->create([
            'model_id' => $chromebook->id,
            'building_id' => $building3->id
        ]);
        \App\Models\Device::factory(2)->create([
            'model_id' => $projector->id,
            'building_id' => $building3->id
        ]);
    }
}
