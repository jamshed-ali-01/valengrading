<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        $query = \App\Models\ContactQuery::create($validated);

        // Notify Admin (Database & Email)
        // Notify Admin (Database & Email)
        $adminEmail = \App\Models\SiteSetting::get('admin_notification_email', 'admin@valengrading.com');
        
        \Log::info("Attempting to send contact query email to: {$adminEmail}");
        try {
            \Illuminate\Support\Facades\Notification::route('mail', $adminEmail)
                ->notify(new \App\Notifications\NewContactQuery($query));
            \Log::info("Email notification queued/bound for: {$adminEmail}");
        } catch (\Exception $e) {
            \Log::error("Failed to send contact email: " . $e->getMessage());
        }

        // Also notify DB admins for dashboard alerts (database channel only)
        $admins = \App\Models\User::where('role', 'admin')->get();
        \Log::info("Found " . $admins->count() . " admin users for DB notification.");
        \Illuminate\Support\Facades\Notification::send($admins, new \App\Notifications\NewContactQuery($query, ['database']));

        // Broadcast Real-time Event
        \Log::info("Broadcasting NewContactQueryEvent");
        event(new \App\Events\NewContactQueryEvent($query));

        // Send Auto-Reply to User
        if ($validated['email']) {
            try {
                \Illuminate\Support\Facades\Mail::to($validated['email'])->send(new \App\Mail\ContactUserConfirmation($query));
                \Log::info("Auto-reply sent to user: " . $validated['email']);
            } catch (\Exception $e) {
                \Log::error("Failed to send auto-reply to user: " . $e->getMessage());
            }
        }

        return back()->with('success', 'Your message has been sent successfully! We will get back to you soon.');

    }
}
