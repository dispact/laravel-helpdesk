<?php

namespace Tests\Feature\DeviceModelManagement;

use Tests\TestCase;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Livewire\DeviceModel\CreateModal;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeviceModelCreateModalTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function device_model_management_page_contains_create_modal_livewire_component() {
        $this->actingAs($this->pretendToBeStaff());

        $this->get('/manage/models')->assertSeeLivewire('device-model.create-modal');
    }

    /** @test */
    public function device_model_create_modal_emits_event() {
        $this->actingAs($this->pretendToBeStaff());

        Livewire::test(CreateModal::class)
            ->set('name', 'New device')
            ->set('manufacturer', 3)
            ->set('type', 4)
            ->call('emitEvent')
            ->assertEmitted('createDeviceModel');
    }
}
