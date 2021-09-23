<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Models\DeviceModel;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Livewire\DeviceModel\Management;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeviceModelManagementTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function non_staff_user_cannot_access_device_model_management_page() {
        $this->actingAs($this->createUser());

        $this->get('/manage/models')->assertStatus(404);
    }

    /** @test */
    public function staff_user_can_access_device_model_management_page() {
        $this->actingAs($this->pretendToBeStaff());

        $this->get('/manage/models')->assertStatus(200);
    }

    /** @test */
    public function device_model_management_page_contains_livewire_component() {
        $this->actingAs($this->pretendToBeStaff());

        $this->get('/manage/models')->assertSeeLivewire('device-model.management');
    }

    /** @test */
    public function can_create_device_models() {
        $this->actingAs($this->pretendToBeStaff());

        Livewire::test(Management::class)
            ->call('create', [
                'name' => 'Laptop',
                'manufacturer' => '1',
                'type' => '1'
            ])
            ->assertEmitted('flashSuccess');
            
        $this->assertDatabaseHas('device_models', [
            'name' => 'Laptop'
        ]);
    }

    /** @test */
    public function can_edit_device_models() {
        $this->actingAs($this->pretendToBeStaff());

        $model = \App\Models\DeviceModel::factory()->create();

        Livewire::test(Management::class)
            ->call('update', [
                'id' => $model->id,
                'name' => 'Updated device',
                'manufacturer' => $model->manufacturer,
                'type' => $model->type
                
            ])
            ->assertEmitted('flashSuccess');
            
        $this->assertDatabaseHas('device_models', [
            'name' => 'Updated device'
        ]);
    }

    /** @test */
    public function can_delete_device_models() {
        $this->actingAs($this->pretendToBeStaff());

        $model = DeviceModel::factory()->create();

        Livewire::test(Management::class)
            ->call('delete', $model->id)
            ->assertEmitted('flashSuccess');
            
        $this->assertDeleted($model);
    }
}
