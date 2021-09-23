<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Http\Livewire\Category\Management;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function non_staff_user_cannot_access_category_management_page() {
        $this->actingAs($this->createUser());

        $this->get('/manage/categories')->assertStatus(404);
    }

    /** @test */
    public function staff_user_can_access_category_management_page() {
        $this->actingAs($this->pretendToBeStaff());

        $this->get('/manage/categories')->assertStatus(200);
    }

    /** @test */
    public function category_management_page_contains_livewire_component() {
        $this->actingAs($this->pretendToBeStaff());

        $this->get('/manage/categories')->assertSeeLivewire('category.management');
    }

    /** @test */
    public function can_create_categories() {
        $this->actingAs($this->pretendToBeStaff());

        Livewire::test(Management::class)
            ->call('create', [
                'name' => 'Test Category'
            ])
            ->assertEmitted('flashSuccess');
            
        $this->assertDatabaseHas('categories', [
            'name' => 'Test Category'
        ]);
    }

    /** @test */
    public function can_edit_categories() {
        $this->actingAs($this->pretendToBeStaff());

        $category = \App\Models\Category::factory()->create();

        Livewire::test(Management::class)
            ->call('update', [
                'id' => $category->id,
                'name' => 'Updated category',
            ])
            ->assertEmitted('flashSuccess');
            
        $this->assertDatabaseHas('categories', [
            'name' => 'Updated category'
        ]);
    }

    /** @test */
    public function can_delete_categories() {
        $this->actingAs($this->pretendToBeStaff());

        $category = \App\Models\Category::factory()->create();

        Livewire::test(Management::class)
            ->call('delete', $category->id)
            ->assertEmitted('flashSuccess');
            
        $this->assertDeleted($category);
    }
}
