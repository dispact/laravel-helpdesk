<?php

namespace Tests\Feature\DeviceModelManagement;

use Tests\TestCase;
use Livewire\Livewire;
use App\Models\DeviceModel;
use App\Http\Livewire\DeviceModel\EditModal;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeviceModelEditModalTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function device_model_management_page_contains_edit_modal_livewire_component() {
        $this->actingAs($this->pretendToBeStaff());

        $this->get('/manage/models')->assertSeeLivewire('device-model.edit-modal');
    }

    /** @test */
    public function device_model_edit_modal_emits_event() {
        $this->actingAs($this->pretendToBeStaff());

        $model = DeviceModel::factory()->create();

        Livewire::test(EditModal::class)
            ->set('id_', $model->id)
            ->set('name', 'updated device')
            ->set('manufacturer', $model->manufacturer)
            ->set('type', $model->type)
            ->call('emitEvent')
            ->assertEmitted('updateDeviceModel');
    }
}
