<?php

namespace App\Http\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Management extends Component
{
    use WithPagination;

    protected $listeners = [
        'createCategory' => 'create',
        'updateCategory' => 'update',
        'deleteCategory' => 'delete',
    ];

    public function create($payload) {
        try {
            // Validate the information and make sure
            // the category doesn't already exist
            $validated = Validator::make($payload, [
                'name' => 'required|string|unique:categories,name'
            ])->validate();

            try {
                // Create the category
                Category::create($validated);
                $this->dispatchBrowserEvent('successMessage', ['message' => 'Category created']);
                $this->emitTo('category.create-modal', 'show');
            } catch (\exception $e) {
                $this->dispatchBrowserEvent('errorMessage', ['message' => 'Error creating category']);
            }
        } catch (ValidationException $e) {
            foreach($e->errors() as $key=>$error) {
                $this->addError('create_' . $key, $error[0]);
            }
            $this->emit('createCategoryErrorBag', $this->getErrorBag());
        }
    }

    public function update($payload) {
        try {
            // Check if updated category name was entered and doesn't already exists
            $validated = Validator::make($payload, [
                'id' => 'required',
                'name' => 'required|string|unique:categories,name,' . $payload['id']
            ])->validate();

            // Update the category name
            try{
                $category = Category::find($payload['id']);
                $category->name = $payload['name'];
                $category->save();
                $this->dispatchBrowserEvent('successMessage', ['message' => 'Category updated']);
                $this->emitTo('category.edit-modal', 'show');
            } catch (\exception $e) {
                $this->dispatchBrowserEvent('errorMessage', ['message' => 'Error updating category']);
            }

        } catch (ValidationException $e) {
            foreach($e->errors() as $key=>$error) {
                $this->addError('edit_' . $key, $error[0]);
            }
            $this->emit('editCategoryErrorBag', $this->getErrorBag());
        }
    }

    public function delete($id) {
        try {
            // Validate the information and make sure 
            // the category ID exists
            Validator::make(
                ['id' => $id],
                ['id' => 'required|exists:categories']
            )->validate();

            try {
                // Delete the category
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
        return view('livewire.category.management', [
            'categories' => Category::latest('updated_at')
                ->paginate(10)
        ]);
    }
}
