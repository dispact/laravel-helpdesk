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
            'color' => 'green'
        ]);
        \App\Models\Status::factory()->create([
            'name' => 'Pending',
            'color' => 'orange'
        ]);
        \App\Models\Status::factory()->create([
            'name' => 'Closed',
            'color' => 'red'
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
        // \App\Models\Ticket::factory(2)->create([
        //     'building_id' => '1',
        //     'category_id' => '2',
        //     'status_id' => '2'
        // ]);
        // \App\Models\Ticket::factory(3)->create([
        //     'staff_id' => '1',
        //     'building_id' => '1',
        //     'category_id' => '3',
        //     'status_id' => '3'
        // ]);
    }
}
