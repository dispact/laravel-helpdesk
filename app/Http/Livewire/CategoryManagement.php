<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CategoryManagement extends Component
{
    use WithPagination;

    protected $listeners = [
        'createCategory' => 'create',
        'updateCategory' => 'update',
        'deleteCategory' => 'delete',
    ];

    public function create($name) {
        try {
            // Check if category name was entered and doesn't already exists
            Validator::make(
                ['name' => $name],
                ['name' => 'required|unique:categories,name']
            )->validate();

            // Create the category
            try {
                Category::create([
                    'name' => $name
                ]);
                $this->dispatchBrowserEvent('successMessage', ['message' => 'Category created']);
            } catch (\exception $e) {
                $this->dispatchBrowserEvent('errorMessage', ['message' => 'Error creating category']);
            }
        } catch (ValidationException $e) {
            $this->dispatchBrowserEvent('errorMessage', ['message' => $e->errors()['name'][0]]);
        }
    }

    public function update($id, $name) {
        try {
            // Check if updated category name was entered and doesn't already exists
            Validator::make(
                ['name' => $name],
                ['name' => 'required|unique:categories,name,' . $id]
            )->validate();

            // Update the category name
            try{
                $category = Category::find($id);
                $category->name = $name;
                $category->save();
                $this->dispatchBrowserEvent('successMessage', ['message' => 'Category updated']);
            } catch (\exception $e) {
                $this->dispatchBrowserEvent('errorMessage', ['message' => 'Error updating category']);
            }

        } catch (ValidationException $e) {
            $this->dispatchBrowserEvent('errorMessage', ['message' => $e->errors()['name'][0]]);
        }
    }

    public function delete($id) {
        try {
            // Make sure category id exists
            Validator::make(
                ['id' => $id],
                ['id' => 'required|exists:categories']
            )->validate();

            // Delete the category
            try {
                Category::find($id)->delete();
                $this->dispatchBrowserEvent('successMessage', ['message' => 'Category deleted']);
            } catch (\exception $e) {
                $this->dispatchBrowserEvent('errorMessage', ['message' => 'Error deleting category']);
            }
        } catch (ValidationException $e) {
            $this->dispatchBrowserEvent('errorMessage', ['message' => $e->errors()['id'][0]]);
        }
    }


    public function paginationView() {
        return 'vendor/livewire/tailwind';
    }

    public function render() {
        return view('livewire.category-management', [
            'categories' => Category::latest('updated_at')
                ->paginate(10)
        ]);
    }
}
