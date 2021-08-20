<?php

namespace App\View\Components\Filters;

use App\Models\Category;
use Illuminate\View\Component;

class CategoryDropdown extends Component
{
    public function render()
    {
        if (!is_null(request('category'))) {
            $currentCategory = Category::firstWhere('id', request('category'));
        } else {
            $currentCategory = null;
        }
        
        return view('components.filters.category-dropdown', [
            'categories' => Category::all(),
            'currentCategory' => $currentCategory
        ]);
    }
}
