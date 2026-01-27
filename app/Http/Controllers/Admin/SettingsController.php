<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = [
            'admin_notification_email' => SiteSetting::get('admin_notification_email', 'admin@valengrading.com'),
            
            // SMTP Settings
            'mail_host' => SiteSetting::get('mail_host', 'smtp.mailtrap.io'),
            'mail_port' => SiteSetting::get('mail_port', '2525'),
            'mail_username' => SiteSetting::get('mail_username', ''),
            'mail_password' => SiteSetting::get('mail_password', ''),
            'mail_encryption' => SiteSetting::get('mail_encryption', 'tls'),
            'mail_from_address' => SiteSetting::get('mail_from_address', 'hello@valengrading.com'),
            'mail_from_name' => SiteSetting::get('mail_from_name', 'Valen Grading'),

            // Shipping Settings
            'shipping_name' => SiteSetting::get('shipping_name', 'Valen Grading'),
            'shipping_address' => SiteSetting::get('shipping_address', ''),
            'shipping_city' => SiteSetting::get('shipping_city', ''),
            'shipping_state' => SiteSetting::get('shipping_state', ''),
            'shipping_zip' => SiteSetting::get('shipping_zip', ''),
            'shipping_country' => SiteSetting::get('shipping_country', 'United Kingdom'),
            'shipping_phone' => SiteSetting::get('shipping_phone', ''),
        ];

        return view('admin.settings.index', $settings);
    }

    public function updateGeneral(Request $request)
    {
        $request->validate([
            'admin_notification_email' => 'required|email',
        ]);

        SiteSetting::set('admin_notification_email', $request->admin_notification_email);

        return back()->with('success', 'General settings updated successfully.');
    }

    public function updateSMTP(Request $request)
    {
        $data = $request->validate([
            'mail_host' => 'required',
            'mail_port' => 'required',
            'mail_username' => 'nullable',
            'mail_password' => 'nullable',
            'mail_encryption' => 'required',
            'mail_from_address' => 'required|email',
            'mail_from_name' => 'required',
        ]);

        foreach ($data as $key => $value) {
            SiteSetting::set($key, $value, 'smtp');
        }

        return back()->with('success', 'SMTP settings updated successfully.');
    }

    public function updateShipping(Request $request)
    {
        $data = $request->validate([
            'shipping_name' => 'required',
            'shipping_address' => 'required',
            'shipping_phone' => 'nullable',
        ]);

        foreach ($data as $key => $value) {
            SiteSetting::set($key, $value, 'shipping');
        }

        return back()->with('success', 'Shipping address updated successfully.');
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->fill($request->all());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return back()->with('success', 'Profile information updated.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ], [
            'current_password.current_password' => 'The provided password does not match our records.'
        ]);

        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password updated successfully.');
    }
}
