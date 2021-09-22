<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

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
}
