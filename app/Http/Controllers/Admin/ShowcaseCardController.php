<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShowcaseCard;
use Illuminate\Http\Request;

class ShowcaseCardController extends Controller
{
    public function index()
    {
        $cards = ShowcaseCard::orderBy('order')->get();
        return view('admin.showcase.index', compact('cards'));
    }

    public function create()
    {
        return view('admin.showcase.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $path = $request->file('image')->store('showcase-cards', 'public');

        ShowcaseCard::create([
            'image_path' => 'storage/' . $path,
            'order' => $request->order ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.showcase.index')->with('success', 'Card added successfully.');
    }

    public function edit(ShowcaseCard $showcase)
    {
        return view('admin.showcase.edit', compact('showcase'));
    }

    public function update(Request $request, ShowcaseCard $showcase)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $data = [
            'order' => $request->order,
            'is_active' => $request->boolean('is_active'),
        ];

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('showcase-cards', 'public');
            $data['image_path'] = 'storage/' . $path;
        }

        $showcase->update($data);

        return redirect()->route('admin.showcase.index')->with('success', 'Card updated successfully.');
    }

    public function destroy(ShowcaseCard $showcase)
    {
        $showcase->delete();
        return redirect()->route('admin.showcase.index')->with('success', 'Card deleted successfully.');
    }
}
