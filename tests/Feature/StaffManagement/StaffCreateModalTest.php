<?php

namespace Tests\Feature\StaffManagement;

use Tests\TestCase;
use Livewire\Livewire;
use App\Http\Livewire\Staff\CreateModal;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StaffCreateModalTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function staff_management_page_contains_create_modal_livewire_component() {
        $this->actingAs($this->pretendToBeStaff());

        $this->get('/manage/staff')->assertSeeLivewire('staff.create-modal');
    }

    /** @test */
    public function staff_create_modal_emits_event() {
        $this->actingAs($this->pretendToBeStaff());

        Livewire::test(CreateModal::class)
            ->set('email', 'test@test.com')
            ->call('emitEvent')
            ->assertEmitted('createStaff');
    }
}
