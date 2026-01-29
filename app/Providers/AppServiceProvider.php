<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('site_settings')) {
                $mailHost = \App\Models\SiteSetting::get('mail_host');
                $mailPort = \App\Models\SiteSetting::get('mail_port');
                $mailUsername = \App\Models\SiteSetting::get('mail_username');
                $mailPassword = \App\Models\SiteSetting::get('mail_password');
                $mailEncryption = \App\Models\SiteSetting::get('mail_encryption');
                $mailFromAddress = \App\Models\SiteSetting::get('mail_from_address');
                $mailFromName = \App\Models\SiteSetting::get('mail_from_name');

                if ($mailHost) {
                    config([
                        'mail.default' => 'smtp',
                        'mail.mailers.smtp.host' => $mailHost,
                        'mail.mailers.smtp.port' => $mailPort,
                        'mail.mailers.smtp.username' => $mailUsername,
                        'mail.mailers.smtp.password' => $mailPassword,
                        'mail.mailers.smtp.encryption' => $mailEncryption,
                        'mail.from.address' => $mailFromAddress ?? config('mail.from.address'),
                        'mail.from.name' => $mailFromName ?? config('mail.from.name'),
                    ]);
                    \Log::info("Email configuration loaded from database: Host={$mailHost}, User={$mailUsername}");
                } else {
                    \Log::warning("Email settings table found but no mail_host configured.");
                }
            }
        } catch (\Exception $e) {
            // Log error or ignore if DB not ready (e.g. during fresh install)
        }
    }
}
