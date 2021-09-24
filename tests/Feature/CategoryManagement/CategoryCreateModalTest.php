<?php

namespace Tests\Feature\CategoryManagement;

use Tests\TestCase;
use Livewire\Livewire;
use App\Http\Livewire\Category\CreateModal;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryCreateModalTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function category_management_page_contains_create_modal_livewire_component() {
        $this->actingAs($this->pretendToBeStaff());

        $this->get('/manage/categories')->assertSeeLivewire('category.create-modal');
    }

    /** @test */
    public function category_create_modal_emits_event() {
        $this->actingAs($this->pretendToBeStaff());

        Livewire::test(CreateModal::class)
            ->set('name', 'New category')
            ->call('emitEvent')
            ->assertEmitted('createCategory');
    }
}
