<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceLevel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceLevelController extends Controller
{
    public function index(): View
    {
        $serviceLevels = ServiceLevel::orderBy('order')->get();

        return view('admin.service-levels.index', compact('serviceLevels'));
    }

    public function create(): View
    {
        return view('admin.service-levels.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'delivery_time' => 'required|string|max:255',
            'min_submission' => 'nullable|integer|min:0',
            'price_per_card' => 'required|numeric|min:0',
            'order' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);

        // Convert string to boolean
        $validated['is_active'] = (bool) $validated['is_active'];

        ServiceLevel::create($validated);

        return redirect()
            ->route('admin.service-levels.index')
            ->with('success', 'Service Level created successfully.');
    }

    public function edit(ServiceLevel $serviceLevel): View
    {
        return view('admin.service-levels.edit', compact('serviceLevel'));
    }

    public function update(Request $request, ServiceLevel $serviceLevel): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'delivery_time' => 'required|string|max:255',
            'min_submission' => 'nullable|integer|min:0',
            'price_per_card' => 'required|numeric|min:0',
            'order' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);

        // Convert string to boolean
        $validated['is_active'] = (bool) $validated['is_active'];

        $serviceLevel->update($validated);

        return redirect()
            ->route('admin.service-levels.index')
            ->with('success', 'Service Level updated successfully.');
    }

    public function destroy(ServiceLevel $serviceLevel): RedirectResponse
    {
        $serviceLevel->delete();

        return redirect()
            ->route('admin.service-levels.index')
            ->with('success', 'Service Level deleted successfully.');
    }
}
