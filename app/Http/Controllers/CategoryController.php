<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        return view('categories.index', [
            'categories' => Category::latest('updated_at')
                ->filter(request(['search']))
                ->paginate(10)
        ]);
    }

    public function store(Request $request) {
        try {
            $request->validate([
                'name' => 'required',
            ]);

            Category::create([
                'name' => $request->name
            ]);

            return response()->json(['msg' => 'Category created!'], 200);
          
        } catch (\exception $e) {
            return response()->json(['msg' => 'Error creating category...'], 400);
        }
    }

    public function update(Request $request) {
        try {
            $request->validate([
                'name' => 'required',
                'category_id' => 'required'
            ]);

            $category = Category::find($request->category_id);
            $category->name = $request->name;
            $category->save();

            return response()->json(['msg' => 'Category updated!'], 200);
          
        } catch (\exception $e) {
            return response()->json(['msg' => 'Error updating category...'], 400);
        }
    }

    public function destroy(Request $request) {
        try {
            $request->validate([
                'category_id' => 'required'
            ]);

            $category = Category::find($request->category_id);
            $category->delete();

            return response()->json(['msg' => 'Category deleted!'], 200);
        } catch (\exception $e) {
            return response()->json(['msg' => 'Error deleting category...'], 400);
        }
    }
}
