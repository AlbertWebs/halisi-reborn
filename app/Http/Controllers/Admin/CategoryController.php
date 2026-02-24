<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JourneyCategory;
use App\Models\Journey;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = JourneyCategory::orderBy('sort_order')->orderBy('name')->paginate(20);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:journey_categories,slug',
            'sort_order' => 'nullable|integer',
        ]);

        if (!$request->filled('slug')) {
            $validated['slug'] = Str::slug($validated['name']);
        }
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        JourneyCategory::create($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(JourneyCategory $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, JourneyCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:journey_categories,slug,' . $category->id,
            'sort_order' => 'nullable|integer',
        ]);

        if (!$request->filled('slug')) {
            $validated['slug'] = Str::slug($validated['name']);
        }
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $category->update($validated);

        // Keep journey_category in sync on all journeys in this category
        Journey::where('journey_category_id', $category->id)->update(['journey_category' => $category->name]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(JourneyCategory $category)
    {
        $count = $category->journeys()->count();
        if ($count > 0) {
            return redirect()->route('admin.categories.index')->with('error', "Cannot delete category. It is used by {$count} journey(s). Remove or reassign journeys first.");
        }

        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
