<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Staff;
use Livewire\Livewire;
use App\Http\Livewire\Staff\Management;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StaffManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function non_staff_user_cannot_access_staff_management_page() {
        $this->actingAs($this->createUser());

        $this->get('/manage/staff')->assertStatus(404);
    }

    /** @test */
    public function staff_user_can_access_staff_management_page() {
        $this->actingAs($this->pretendToBeStaff());

        $this->get('/manage/staff')->assertStatus(200);
    }

    /** @test */
    public function staff_management_page_contains_livewire_component() {
        $this->actingAs($this->pretendToBeStaff());

        $this->get('/manage/staff')->assertSeeLivewire('staff.management');
    }

    /** @test */
    public function can_create_staff() {
        $this->actingAs($this->pretendToBeStaff());

        $user = $this->createUser();

        Livewire::test(Management::class)
            ->call('create', [
                'email' => $user->email,
                'category' => null,
                'building' => null
            ])
            ->assertDispatchedBrowserEvent('successMessage');
            
        $this->assertDatabaseHas('staff', [
            'user_id' => $user->id
        ]);
    }

    /** @test */
    public function can_edit_staff() {
        $this->actingAs($this->pretendToBeStaff());

        $staff = $this->createStaff();
        $building = \App\Models\Building::factory()->create();
        $category = \App\Models\Category::factory()->create();

        Livewire::test(Management::class)
            ->call('update', [
                'id' => $staff->id,
                'category' => [$category->id],
                'building' => [$building->id]
            ])
            ->assertDispatchedBrowserEvent('successMessage');
    
        $this->assertDatabaseHas('category_staff', [
            'staff_id' => $staff->id
        ]);

        $this->assertDatabaseHas('building_staff', [
            'staff_id' => $staff->id
        ]);
    }

    /** @test */
    public function can_delete_staff() {
        $this->actingAs($this->pretendToBeStaff());

        $staff = $this->createStaff();

        Livewire::test(Management::class)
            ->call('delete', $staff->id)
            ->assertDispatchedBrowserEvent('successMessage');
            
        $this->assertDeleted($staff);
    }
}
