<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submission Received</title>
</head>
<body style="font-family: 'Outfit', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #ffffff; color: #333333; margin: 0; padding: 0;">
    <!-- Outer wrapper for white bg -->
    <div style="background-color: #ffffff; padding: 20px;">
        <div style="max-width: 600px; margin: 0 auto; background-color: #f9fafb; border: 1px solid #e5e7eb; border-radius: 12px; overflow: hidden;">
            
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
            
            <div style="padding: 40px 30px;">
                <div style="text-align: center; margin-bottom: 30px;">
                    <h2 style="color: #111827; font-size: 24px; font-weight: 800; margin: 0; text-transform: uppercase; letter-spacing: 0.5px;">Submission Received</h2>
                    <div style="height: 4px; width: 40px; background-color: #A3050A; margin: 15px auto 0; border-radius: 2px;"></div>
                </div>

                <p style="margin-top: 0; font-size: 16px; color: #111827; text-align: center;">Hi <strong>{{ $submission->user->name ?? $submission->shippingAddress->full_name ?? 'Collector' }}</strong>,</p>
                <p style="color: #4B5563; font-size: 15px; text-align: center; margin-bottom: 30px;">We've received your submission <strong style="color: #A3050A;">#{{ $submission->submission_no }}</strong>. Our team is ready to provide the highest quality grading for your treasures.</p>

                <!-- Details Grid -->
                <div style="margin: 25px 0; background-color: #ffffff; padding: 25px; border-radius: 12px; border: 1px solid #e5e7eb; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="padding-bottom: 15px; width: 50%;">
                                <span style="font-weight: bold; color: #6B7280; display: block; text-transform: uppercase; font-size: 11px; margin-bottom: 4px;">Service Level</span>
                                <span style="color: #111827; font-weight: 600;">{{ $submission->serviceLevel->name }}</span>
                            </td>
                            <td style="padding-bottom: 15px; width: 50%;">
                                <span style="font-weight: bold; color: #6B7280; display: block; text-transform: uppercase; font-size: 11px; margin-bottom: 4px;">Total Cards</span>
                                <span style="color: #111827; font-weight: 600;">{{ $submission->card_entry_mode === 'detailed' ? $submission->cards->sum('qty') : $submission->total_cards }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span style="font-weight: bold; color: #6B7280; display: block; text-transform: uppercase; font-size: 11px; margin-bottom: 4px;">Payment Status</span>
                                <span style="display: inline-block; padding: 4px 12px; border-radius: 9999px; font-size: 11px; font-weight: 700; text-transform: uppercase; background-color: #DEF7EC; color: #03543F;">Paid</span>
                            </td>
                            <td>
                                <span style="font-weight: bold; color: #6B7280; display: block; text-transform: uppercase; font-size: 11px; margin-bottom: 4px;">Total Cost</span>
                                <span style="color: #111827; font-weight: 600;">€{{ number_format($submission->total_cost, 2) }}</span>
                            </td>
                        </tr>
                    </table>
                </div>

                <h3 style="color: #111827; margin-top: 30px; font-size: 18px;">Next Steps:</h3>
                <ol style="font-size: 15px; color: #4B5563; margin-bottom: 30px; padding-left: 20px; line-height: 1.6;">
                    <li style="margin-bottom: 8px;">Print your packing slip using the button below.</li>
                    <li style="margin-bottom: 8px;">Securely package your cards.</li>
                    <li>Send them to the address mentioned on the packing slip.</li>
                </ol>

                <div style="text-align: center; margin: 40px 0;">
                    <a href="{{ route('submission.packingSlip.download', $submission->id) }}" style="display: inline-block; padding: 14px 32px; background-color: #A3050A; color: #ffffff; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 16px; box-shadow: 0 4px 6px -1px rgba(163,5,10,0.2);">Download Packing Slip</a>
                </div>

                @if($submission->card_entry_mode === 'detailed')
                <div style="border-top: 2px solid #e5e7eb; margin-top: 30px; padding-top: 20px;">
                    <h3 style="font-size: 16px; margin: 0 0 15px 0; color: #111827;">Submitted Cards</h3>
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th style="text-align: left; padding: 10px 0; color: #6B7280; font-size: 11px; text-transform: uppercase; border-bottom: 1px solid #e5e7eb;">Card Title</th>
                                <th style="text-align: left; padding: 10px 0; color: #6B7280; font-size: 11px; text-transform: uppercase; border-bottom: 1px solid #e5e7eb;">Set/Year</th>
                                <th style="text-align: center; padding: 10px 0; color: #6B7280; font-size: 11px; text-transform: uppercase; border-bottom: 1px solid #e5e7eb;">Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($submission->cards as $card)
                            <tr>
                                <td style="padding: 12px 0; border-bottom: 1px solid #f3f4f6; color: #111827; font-size: 14px;">{{ $card->title }}</td>
                                <td style="padding: 12px 0; border-bottom: 1px solid #f3f4f6; color: #6B7280; font-size: 13px;">{{ $card->set_name }} {{ $card->year }}</td>
                                <td style="padding: 12px 0; border-bottom: 1px solid #f3f4f6; color: #111827; font-weight: bold; text-align: center;">{{ $card->qty ?? 1 }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>

            <div style="text-align: center; padding: 30px 20px; border-top: 1px solid #e5e7eb; background-color: #f3f4f6; color: #9CA3AF; font-size: 12px;">
                <p style="margin: 0 0 5px 0;">&copy; {{ date('Y') }} {{ \App\Models\SiteSetting::get('site_name', 'Valen Grading') }}. All rights reserved.</p>
                <p style="margin: 0;">If you have any questions, please contact us at support@valengrading.com</p>
            </div>
        </div>
    </div>
</body>
</html>
