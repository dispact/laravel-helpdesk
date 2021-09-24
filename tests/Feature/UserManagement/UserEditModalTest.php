<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Http\Livewire\User\EditModal;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserEditModalTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_management_page_contains_edit_modal_livewire_component() {
        $this->actingAs($this->pretendToBeStaff());

        $this->get('/manage/users')->assertSeeLivewire('user.edit-modal');
    }

    /** @test */
    public function user_edit_modal_emits_event() {
        $this->actingAs($this->pretendToBeStaff());

        $user = $this->createUser();

        Livewire::test(EditModal::class)
            ->set('id_', $user->id)
            ->set('name', 'editNameTest')
            ->set('email', $user->email)
            ->set('building', $user->building_id)
            ->call('emitEvent')
            ->assertEmitted('updateUser');
    }
}