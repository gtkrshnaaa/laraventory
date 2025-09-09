<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Category;

class CategoryController extends Controller
{
    // Display a listing of the resource.
    public function index(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.panel.categories.index', [
            'title' => 'Categories',
            'categories' => $categories,
        ]);
    }

    // Store a newly created resource in storage.
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
        ]);

        Category::create($validated);

        return redirect()->route('admin.categories.index')->with('status', 'Category created');
    }

    // Update the specified resource in storage.
    public function update(Request $request, int $category): RedirectResponse
    {
        $model = Category::findOrFail($category);
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $model->id,
            'description' => 'nullable|string',
        ]);

        $model->update($validated);

        return redirect()->route('admin.categories.index')->with('status', 'Category updated');
    }

    // Remove the specified resource from storage.
    public function destroy(int $category): RedirectResponse
    {
        $model = Category::findOrFail($category);
        // Optional: prevent delete if has products
        // if ($model->products()->exists()) {
        //     return redirect()->route('admin.categories.index')->with('status', 'Cannot delete category with products');
        // }
        $model->delete();

        return redirect()->route('admin.categories.index')->with('status', 'Category deleted');
    }
}

