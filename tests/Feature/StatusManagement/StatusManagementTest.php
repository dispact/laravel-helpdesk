<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Status;
use Livewire\Livewire;
use App\Http\Livewire\Status\Management;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatusManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function non_staff_user_cannot_access_status_management_page() {
        $this->actingAs($this->createUser());

        $this->get('/manage/statuses')->assertStatus(404);
    }

    /** @test */
    public function staff_user_can_access_status_management_page() {
        $this->actingAs($this->pretendToBeStaff());

        $this->get('/manage/statuses')->assertStatus(200);
    }

    /** @test */
    public function status_management_page_contains_livewire_component() {
        $this->actingAs($this->pretendToBeStaff());

        $this->get('/manage/statuses')->assertSeeLivewire('status.management');
    }

    /** @test */
    public function can_create_statuses() {
        $this->actingAs($this->pretendToBeStaff());

        Livewire::test(Management::class)
            ->call('create', [
                'name' => 'Test Status',
                'color' => '5'
            ])
            ->assertEmitted('flashSuccess');
            
        $this->assertDatabaseCount('statuses', 1);
    }

    /** @test */
    public function can_edit_statuses() {
        $this->actingAs($this->pretendToBeStaff());

        $status = Status::factory()->create();

        Livewire::test(Management::class)
            ->call('update', [
                'id' => $status->id,
                'name' => 'Updated status',
                'color' => $status->color
            ])
            ->assertEmitted('flashSuccess');
            
        $this->assertDatabaseHas('statuses', [
            'name' => 'Updated status'
        ]);
    }

    /** @test */
    public function can_delete_statuses() {
        $this->actingAs($this->pretendToBeStaff());

        $status = Status::factory()->create();

        Livewire::test(Management::class)
            ->call('delete', $status->id)
            ->assertEmitted('flashSuccess');
            
        $this->assertDeleted($status);
    }

}
