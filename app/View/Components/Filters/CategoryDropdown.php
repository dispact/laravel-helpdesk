<?php

namespace App\View\Components\Filters;

use App\Models\Category;
use Illuminate\View\Component;

class CategoryDropdown extends Component
{
    public function render()
    {
        return view('components.filters.category-dropdown', [
            'categories' => Category::all()
        ]);
    }
}
