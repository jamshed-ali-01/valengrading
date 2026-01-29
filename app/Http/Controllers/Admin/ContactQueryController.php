<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactQueryController extends Controller
{
    public function index()
    {
        $queries = \App\Models\ContactQuery::latest()->paginate(10);
        return view('admin.contact-queries.index', compact('queries'));
    }

    public function show(\App\Models\ContactQuery $contactQuery)
    {
        if (!$contactQuery->is_read) {
            $contactQuery->update(['is_read' => true]);
        }
        return view('admin.contact-queries.show', compact('contactQuery'));
    }

    public function destroy(\App\Models\ContactQuery $contactQuery)
    {
        $contactQuery->delete();
        return redirect()->route('admin.contact-queries.index')->with('success', 'Contact query deleted successfully.');
    }
}
