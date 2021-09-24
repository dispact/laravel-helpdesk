<?php

namespace Tests\Feature\StatusManagement;

use Tests\TestCase;
use Livewire\Livewire;
use App\Http\Livewire\Status\CreateModal;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatusCreateModalTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function status_management_page_contains_create_modal_livewire_component() {
        $this->actingAs($this->pretendToBeStaff());

        $this->get('/manage/statuses')->assertSeeLivewire('status.create-modal');
    }

    /** @test */
    public function status_create_modal_emits_event() {
        $this->actingAs($this->pretendToBeStaff());

        Livewire::test(CreateModal::class)
            ->set('name', 'Test Status')
            ->set('color', 5)
            ->call('emitEvent')
            ->assertEmitted('createStatus');
    }
}
