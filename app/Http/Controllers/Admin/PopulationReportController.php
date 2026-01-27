<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PopulationReport;
use Illuminate\Http\Request;

class PopulationReportController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $query = PopulationReport::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('set_name', 'like', "%{$search}%")
                  ->orWhere('card_number', 'like', "%{$search}%");
            });
        }

        $reports = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.population.index', compact('reports'));
    }

    public function create()
    {
        return view('admin.population.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'year' => 'nullable|string|max:4',
            'brand' => 'nullable|string|max:255',
            'set_name' => 'nullable|string|max:255',
            'card_number' => 'nullable|string|max:50',
            'title' => 'required|string|max:255',
            'rarity' => 'nullable|string|max:255',
            'grade_1' => 'required|integer|min:0',
            'grade_2' => 'required|integer|min:0',
            'grade_3' => 'required|integer|min:0',
            'grade_4' => 'required|integer|min:0',
            'grade_5' => 'required|integer|min:0',
            'grade_6' => 'required|integer|min:0',
            'grade_7' => 'required|integer|min:0',
            'grade_8' => 'required|integer|min:0',
            'grade_9' => 'required|integer|min:0',
            'grade_10' => 'required|integer|min:0',
        ]);

        // Calculate total
        $validated['total'] = $validated['grade_1'] + $validated['grade_2'] + $validated['grade_3'] + 
                              $validated['grade_4'] + $validated['grade_5'] + $validated['grade_6'] + 
                              $validated['grade_7'] + $validated['grade_8'] + $validated['grade_9'] + 
                              $validated['grade_10'];

        PopulationReport::create($validated);

        return redirect()->route('admin.population.index')->with('success', 'Population Report entry created successfully.');
    }

    public function edit(PopulationReport $populationReport)
    {
        return view('admin.population.edit', compact('populationReport'));
    }

    public function update(Request $request, PopulationReport $populationReport)
    {
        $validated = $request->validate([
            'year' => 'nullable|string|max:4',
            'brand' => 'nullable|string|max:255',
            'set_name' => 'nullable|string|max:255',
            'card_number' => 'nullable|string|max:50',
            'title' => 'required|string|max:255',
            'rarity' => 'nullable|string|max:255',
            'grade_1' => 'required|integer|min:0',
            'grade_2' => 'required|integer|min:0',
            'grade_3' => 'required|integer|min:0',
            'grade_4' => 'required|integer|min:0',
            'grade_5' => 'required|integer|min:0',
            'grade_6' => 'required|integer|min:0',
            'grade_7' => 'required|integer|min:0',
            'grade_8' => 'required|integer|min:0',
            'grade_9' => 'required|integer|min:0',
            'grade_10' => 'required|integer|min:0',
        ]);

        // Calculate total
        $validated['total'] = $validated['grade_1'] + $validated['grade_2'] + $validated['grade_3'] + 
                              $validated['grade_4'] + $validated['grade_5'] + $validated['grade_6'] + 
                              $validated['grade_7'] + $validated['grade_8'] + $validated['grade_9'] + 
                              $validated['grade_10'];

        $populationReport->update($validated);

        return redirect()->route('admin.population.index')->with('success', 'Population Report entry updated successfully.');
    }

    public function destroy(PopulationReport $populationReport)
    {
        $populationReport->delete();
        return redirect()->route('admin.population.index')->with('success', 'Population Report entry deleted successfully.');
    }
}
