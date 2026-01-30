<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('order')->get();
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faqs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'question' => 'required|string',
            'answer' => 'required|string',
            'order' => 'required|integer',
            'is_active' => 'boolean',
            'show_on_home' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['show_on_home'] = (bool) $request->input('show_on_home');

        Faq::create($validated);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ created successfully.');
    }

    public function edit(Faq $faq)
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'question' => 'required|string',
            'answer' => 'required|string',
            'order' => 'required|integer',
            'is_active' => 'boolean',
            'show_on_home' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        // For radio buttons, we use the value directly (cast to bool handled by validation/model cast if present, but explicit cast safe)
        $validated['show_on_home'] = (bool) $request->input('show_on_home');

        $faq->update($validated);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ updated successfully.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ deleted successfully.');
    }
}
