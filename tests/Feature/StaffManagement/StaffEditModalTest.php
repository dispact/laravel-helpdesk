<?php

namespace Tests\Feature\StaffManagement;

use Tests\TestCase;
use Livewire\Livewire;
use App\Http\Livewire\Staff\EditModal;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StaffEditModalTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function staff_management_page_contains_edit_modal_livewire_component() {
        $this->actingAs($this->pretendToBeStaff());

        $this->get('/manage/staff')->assertSeeLivewire('staff.edit-modal');
    }

    /** @test */
    public function staff_edit_modal_emits_event() {
        $this->actingAs($this->pretendToBeStaff());

        Livewire::test(EditModal::class)
            ->set('email', 'test@test.com')
            ->call('emitEvent')
            ->assertEmitted('updateStaff');
    }
}
