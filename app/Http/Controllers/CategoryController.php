<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(20);
        return view('settings.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('settings.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:50|unique:categories,category_name',
        ]);
        Category::create($request->only(['category_name']));
        return redirect()->route('settings.categories.index')->with('success', 'Category added!');
    }

    public function edit(Category $category)
    {
        return view('settings.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_name' => 'required|string|max:50|unique:categories,category_name,' . $category->id,
        ]);
        $category->update($request->only(['category_name']));
        return redirect()->route('settings.categories.index')->with('success', 'Category updated!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('settings.categories.index')->with('success', 'Category deleted!');
    }
}