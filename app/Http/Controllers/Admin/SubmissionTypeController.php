<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubmissionType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubmissionTypeController extends Controller
{
    public function index(): View
    {
        $submissionTypes = SubmissionType::orderBy('order')->get();

        return view('admin.submission-types.index', compact('submissionTypes'));
    }

    public function create(): View
    {
        return view('admin.submission-types.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'order' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);

        $validated['is_active'] = (bool) $validated['is_active'];

        SubmissionType::create($validated);

        return redirect()
            ->route('admin.submission-types.index')
            ->with('success', 'Submission Type created successfully.');
    }

    public function edit(SubmissionType $submissionType): View
    {
        return view('admin.submission-types.edit', compact('submissionType'));
    }

    public function update(Request $request, SubmissionType $submissionType): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'order' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);

        $validated['is_active'] = (bool) $validated['is_active'];

        $submissionType->update($validated);

        return redirect()
            ->route('admin.submission-types.index')
            ->with('success', 'Submission Type updated successfully.');
    }

    public function destroy(SubmissionType $submissionType): RedirectResponse
    {
        $submissionType->delete();

        return redirect()
            ->route('admin.submission-types.index')
            ->with('success', 'Submission Type deleted successfully.');
    }
}
