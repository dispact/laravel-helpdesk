<?php

namespace Tests\Feature\StatusManagement;

use Tests\TestCase;
use Livewire\Livewire;
use App\Http\Livewire\Status\EditModal;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatusEditModalTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function status_management_page_contains_create_edit_livewire_component() {
        $this->actingAs($this->pretendToBeStaff());

        $this->get('/manage/statuses')->assertSeeLivewire('status.edit-modal');
    }

    /** @test */
    public function status_edit_modal_emits_event() {
        $this->actingAs($this->pretendToBeStaff());

        Livewire::test(EditModal::class)
            ->set('id_', 1)
            ->set('name', 'Test Status')
            ->set('color', 5)
            ->call('emitEvent')
            ->assertEmitted('updateStatus');
    }
}
