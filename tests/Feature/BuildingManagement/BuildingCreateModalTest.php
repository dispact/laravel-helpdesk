<?php

namespace Tests\Feature\BuildingManagement;

use Tests\TestCase;
use Livewire\Livewire;
use App\Http\Livewire\Building\CreateModal;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BuildingCreateModalTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function building_management_page_contains_create_modal_livewire_component() {
        $this->actingAs($this->pretendToBeStaff());

        $this->get('/manage/buildings')->assertSeeLivewire('building.create-modal');
    }

    /** @test */
    public function building_create_modal_emits_event() {
        $this->actingAs($this->pretendToBeStaff());

        Livewire::test(CreateModal::class)
            ->set('name', 'New building')
            ->call('emitEvent')
            ->assertEmitted('createBuilding');
    }
}
