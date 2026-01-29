<div style="background-color: #f3f4f6; padding: 20px; font-family: 'Outfit', sans-serif;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
        <!-- Header -->
        <div style="background-color: #15171A; padding: 30px;">
            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td align="center">
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="vertical-align: middle; padding-right: 12px;">
                                    <div style="background-color: #A3050A; border-radius: 12px; width: 48px; height: 48px; padding: 8px; box-sizing: border-box; box-shadow: 0 0 20px rgba(163,5,10,0.4);">
                                        <img src="{{ $message->embed(public_path('images/logo.avif')) }}" alt="Valen Grading" style="height: 100%; width: 100%; object-fit: contain; display: block;">
                                    </div>
                                </td>
                                <td style="vertical-align: middle;">
                                    <h1 style="margin: 0; font-size: 20px; font-weight: bold; color: #ef4444; font-family: 'Outfit', sans-serif; line-height: 1.2;">
                                        {{ \App\Models\SiteSetting::get('site_name', 'Valen Grading') }}
                                    </h1>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Content -->
        <div style="padding: 40px 30px; color: #374151;">
            <h2 style="color: #111827; font-size: 24px; font-weight: 600; margin-bottom: 20px;">Thank you for contacting us!</h2>
            
            <p style="margin-bottom: 24px; line-height: 1.6;">Hello {{ $contactQuery->name ?? 'Guest' }},</p>
            <p style="margin-bottom: 24px; line-height: 1.6;">We have successfully received your message. Our team will review it and get back to you as soon as possible.</p>

            <div style="background-color: #f9fafb; border-left: 4px solid #A3050A; padding: 20px; margin-bottom: 30px; border-radius: 4px;">
                <p style="margin: 0 0 10px 0;"><strong>Subject:</strong> {{ $contactQuery->subject ?? 'N/A' }}</p>
                <p style="margin: 0;"><strong>Your Message:</strong></p>
                <p style="margin-top: 10px; white-space: pre-wrap; font-style: italic; color: #6b7280;">"{{ $contactQuery->message }}"</p>
            </div>
            
            <p style="margin-bottom: 20px; line-height: 1.6;">If you have any urgent queries, please check our <a href="{{ route('faq') }}" style="color: #A3050A; text-decoration: none; font-weight: 500;">FAQs</a>.</p>
        </div>

        <!-- Footer -->
        <div style="background-color: #f9fafb; padding: 20px; text-align: center; border-top: 1px solid #e5e7eb;">
            <p style="color: #6b7280; font-size: 12px; margin: 0;">&copy; {{ date('Y') }} {{ \App\Models\SiteSetting::get('site_name', 'Valen Grading') }}. All rights reserved.</p>
        </div>
    </div>
</div>
