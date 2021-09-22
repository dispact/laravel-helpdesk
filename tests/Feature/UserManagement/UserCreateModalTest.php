<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Http\Livewire\User\CreateModal;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserCreateModalTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_management_page_contains_create_modal_livewire_component() {
        $this->actingAs($this->pretendToBeStaff());

        $this->get('/manage/users')->assertSeeLivewire('user.create-modal');
    }

    /** @test */
    public function user_create_modal_emits_event() {
        $this->actingAs($this->pretendToBeStaff());

        Livewire::test(CreateModal::class)
            ->set('name', 'create modal test')
            ->set('email', 'create_modal@test.com')
            ->set('password', 'password')
            ->set('password_confirmation', 'password')
            ->call('emitEvent')
            ->assertEmitted('createUser');
    }
}