<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImpactStat;
use Illuminate\Http\Request;

class ImpactController extends Controller
{
    public function index()
    {
        $stats = ImpactStat::orderBy('sort_order')->get();
        return view('admin.impact.index', compact('stats'));
    }

    public function create()
    {
        return view('admin.impact.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'stat_key' => 'required|string|max:255|unique:impact_stats,stat_key',
            'label' => 'required|string|max:255',
            'value' => 'required|integer',
            'suffix' => 'nullable|string|max:10',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        ImpactStat::create($validated);

        return redirect()->route('admin.impact.index')->with('success', 'Impact stat created successfully.');
    }

    public function edit(ImpactStat $impact)
    {
        return view('admin.impact.edit', compact('impact'));
    }

    public function update(Request $request, ImpactStat $impact)
    {
        $validated = $request->validate([
            'stat_key' => 'required|string|max:255|unique:impact_stats,stat_key,' . $impact->id,
            'label' => 'required|string|max:255',
            'value' => 'required|integer',
            'suffix' => 'nullable|string|max:10',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $impact->update($validated);

        return redirect()->route('admin.impact.index')->with('success', 'Impact stat updated successfully.');
    }

    public function destroy(ImpactStat $impact)
    {
        $impact->delete();

        return redirect()->route('admin.impact.index')->with('success', 'Impact stat deleted successfully.');
    }
}
