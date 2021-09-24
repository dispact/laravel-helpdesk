<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Http\Livewire\Building\Management;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BuildingManagementTest extends TestCase
{
    /** @test */
    public function non_staff_user_cannot_access_building_management_page() {
        $this->actingAs($this->createUser());

        $this->get('/manage/buildings')->assertStatus(404);
    }

    /** @test */
    public function staff_user_can_access_building_management_page() {
        $this->actingAs($this->pretendToBeStaff());

        $this->get('/manage/buildings')->assertStatus(200);
    }

    /** @test */
    public function building_management_page_contains_livewire_component() {
        $this->actingAs($this->pretendToBeStaff());

        $this->get('/manage/buildings')->assertSeeLivewire('building.management');
    }

    /** @test */
    public function can_create_buildings() {
        $this->actingAs($this->pretendToBeStaff());

        Livewire::test(Management::class)
            ->call('create', [
                'name' => 'Test Building'
            ])
            ->assertEmitted('flashSuccess');
            
        $this->assertDatabaseHas('buildings', [
            'name' => 'Test Building'
        ]);
    }

    /** @test */
    public function can_edit_buildings() {
        $this->actingAs($this->pretendToBeStaff());

        $building = \App\Models\Building::factory()->create();

        Livewire::test(Management::class)
            ->call('update', [
                'id' => $building->id,
                'name' => 'Updated building',
            ])
            ->assertEmitted('flashSuccess');
            
        $this->assertDatabaseHas('buildings', [
            'name' => 'Updated building'
        ]);
    }

    /** @test */
    public function can_delete_buildings() {
        $this->actingAs($this->pretendToBeStaff());

        $building = \App\Models\Building::factory()->create();

        Livewire::test(Management::class)
            ->call('delete', $building->id)
            ->assertEmitted('flashSuccess');
            
        $this->assertDeleted($building);
    }
}
