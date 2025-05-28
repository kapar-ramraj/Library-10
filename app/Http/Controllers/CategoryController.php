<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // Display all categories
    public function index()
    {
        $categories = Category::leftJoin('categories as parent', 'categories.parent_id', '=', 'parent.id')
            ->select('categories.*', 'parent.name as parentName')
            ->get();

        return view('library.categories.index', compact('categories'));
    }

    // Show form to create new category
    public function create()
    {
        $parentCategories = Category::whereNull('parent_id')->get();
        return view('library.categories.create', compact('parentCategories'));
    }

    // Store new category
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories|max:255',
            'parent_id' => 'nullable|integer',
            'description' => 'nullable|max:1000',
        ]);
        $validatedData['slug'] = Str::slug($validatedData['name']);
        Category::create($validatedData);

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    // Show a specific category
    public function show(Category $category)
    {
        return view('library.categories.show', compact('category'));
    }

    // Show form to edit category
    public function edit(Category $category)
    {
        $parentCategories = Category::whereNull('parent_id')->get();
        return view('library.categories.edit', compact('category', 'parentCategories'));
    }

    // Update category
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully.');
    }

    // Delete category
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
