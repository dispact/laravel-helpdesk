<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Http\Livewire\User\Management;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function non_staff_user_cannot_access_user_management_page() {
        $this->actingAs($this->createUser());

        $this->get('/manage/users')->assertStatus(404);
    }

    /** @test */
    public function staff_user_can_access_user_management_page() {
        $this->actingAs($this->pretendToBeStaff());

        $this->get('/manage/users')->assertStatus(200);
    }

    /** @test */
    public function user_management_page_contains_livewire_component() {
        $this->actingAs($this->pretendToBeStaff());

        $this->get('/manage/users')->assertSeeLivewire('user.management');
    }

    /** @test */
    public function can_create_users() {
        $this->actingAs($this->pretendToBeStaff());

        Livewire::test(Management::class)
            ->call('create', [
                'name' => 'Test User',
                'email' => 'test@test.com',
                'password' => 'password',
                'password_confirmation' => 'password',
                'building' => null
            ])
            ->assertDispatchedBrowserEvent('successMessage');;
            
        $this->assertDatabaseHas('users', [
            'email' => 'test@test.com'
        ]);
    }

    /** @test */
    public function can_edit_users() {
        $this->actingAs($this->pretendToBeStaff());

        $user = $this->createUser();

        Livewire::test(Management::class)
            ->call('update', [
                'id' => $user->id,
                'name' => $user->name,
                'email' => 'test@test.com',
                'building' => $user->building_id
            ])
            ->assertDispatchedBrowserEvent('successMessage');
            
        $this->assertDatabaseHas('users', [
            'email' => 'test@test.com'
        ]);
    }

    /** @test */
    public function can_delete_users() {
        $this->actingAs($this->pretendToBeStaff());

        $user = $this->createUser();

        Livewire::test(Management::class)
            ->call('delete', $user->id)
            ->assertDispatchedBrowserEvent('successMessage');
            
        $this->assertDeleted($user);
    }
}
