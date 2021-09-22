<?php

namespace Tests\Feature\BuildingManagement;

use Tests\TestCase;
use Livewire\Livewire;
use App\Models\Building;
use App\Http\Livewire\Building\EditModal;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BuildingEditModalTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function building_management_page_contains_edit_modal_livewire_component() {
        $this->actingAs($this->pretendToBeStaff());

        $this->get('/manage/buildings')->assertSeeLivewire('building.edit-modal');
    }

    /** @test */
    public function building_edit_modal_emits_event() {
        $this->actingAs($this->pretendToBeStaff());

        $building = Building::factory()->create();

        Livewire::test(EditModal::class)
            ->set('id_', $building->id)
            ->set('name', 'Update building')
            ->call('emitEvent')
            ->assertEmitted('updateBuilding');
    }
}
