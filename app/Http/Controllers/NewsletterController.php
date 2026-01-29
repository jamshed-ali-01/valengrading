<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $existing = NewsletterSubscriber::where('email', $request->email)->first();

        if ($existing) {
            return response()->json([
                'status' => 'error',
                'message' => 'You are already subscribed!'
            ], 422);
        }

        NewsletterSubscriber::create([
            'email' => $request->email
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully subscribed to our newsletter!'
        ]);
    }
}
