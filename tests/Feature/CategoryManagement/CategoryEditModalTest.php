<?php

namespace Tests\Feature\CategoryManagement;

use Tests\TestCase;
use Livewire\Livewire;
use App\Models\Category;
use App\Http\Livewire\Category\EditModal;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryEditModalTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function category_management_page_contains_edit_modal_livewire_component() {
        $this->actingAs($this->pretendToBeStaff());

        $this->get('/manage/categories')->assertSeeLivewire('category.edit-modal');
    }

    /** @test */
    public function category_edit_modal_emits_event() {
        $this->actingAs($this->pretendToBeStaff());

        $category = Category::factory()->create();

        Livewire::test(EditModal::class)
            ->set('id_', $category->id)
            ->set('name', 'Update category')
            ->call('emitEvent')
            ->assertEmitted('updateCategory');
    }
}
