<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Submission Received</title>
</head>
<body style="font-family: 'Outfit', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #ffffff; color: #333333; margin: 0; padding: 0;">
    <!-- Outer wrapper to ensure white background everywhere -->
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

            <!-- Content -->
            <div style="padding: 40px 30px;">
                <div style="text-align: center; margin-bottom: 30px;">
                    <h2 style="color: #111827; font-size: 24px; font-weight: 800; margin: 0; text-transform: uppercase; letter-spacing: 0.5px;">New Order Received</h2>
                    <div style="height: 4px; width: 40px; background-color: #A3050A; margin: 15px auto 0; border-radius: 2px;"></div>
                </div>

                <p style="font-size: 16px; line-height: 1.6; color: #374151; margin-top: 0; text-align: center;">Hello Admin, a new grading submission <span style="color: #A3050A; font-weight: bold;">#{{ $submission->submission_no }}</span> has been paid and received.</p>
                
                <!-- Info Box -->
                <div style="background-color: #ffffff; border-radius: 12px; padding: 25px; margin: 30px 0; border: 1px solid #e5e7eb; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="padding-bottom: 20px; width: 50%; vertical-align: top;">
                                <div style="color: #6B7280; font-size: 11px; text-transform: uppercase; font-weight: bold; margin-bottom: 5px;">Customer</div>
                                <div style="color: #111827; font-size: 16px; font-weight: 600;">{{ $submission->user->name ?? $submission->shippingAddress->full_name ?? $submission->guest_name }}</div>
                            </td>
                            <td style="padding-bottom: 20px; width: 50%; vertical-align: top;">
                                <div style="color: #6B7280; font-size: 11px; text-transform: uppercase; font-weight: bold; margin-bottom: 5px;">Total Amount</div>
                                <div style="color: #111827; font-size: 16px; font-weight: 600;">€{{ number_format($submission->total_cost, 2) }}</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 50%; vertical-align: top;">
                                <div style="color: #6B7280; font-size: 11px; text-transform: uppercase; font-weight: bold; margin-bottom: 5px;">Service Level</div>
                                <div style="color: #111827; font-size: 16px; font-weight: 600;">{{ $submission->serviceLevel->name }}</div>
                            </td>
                            <td style="width: 50%; vertical-align: top;">
                                <div style="color: #6B7280; font-size: 11px; text-transform: uppercase; font-weight: bold; margin-bottom: 5px;">Total Cards</div>
                                <div style="color: #111827; font-size: 16px; font-weight: 600;">{{ $submission->card_entry_mode === 'detailed' ? $submission->cards->sum('qty') : $submission->total_cards }}</div>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- Shipping -->
                <h3 style="color: #111827; font-size: 18px; margin: 0 0 15px 0; padding-bottom: 10px; border-bottom: 2px solid #e5e7eb;">Shipping Address</h3>
                <div style="margin-bottom: 30px; font-size: 15px; color: #4B5563; line-height: 1.6;">
                    <strong style="color: #111827; display: block; margin-bottom: 4px;">{{ $submission->shippingAddress->full_name }}</strong>
                    {{ $submission->shippingAddress->address_line_1 }}<br>
                    @if($submission->shippingAddress->address_line_2) {{ $submission->shippingAddress->address_line_2 }}<br> @endif
                    {{ $submission->shippingAddress->city }}, {{ $submission->shippingAddress->post_code }}<br>
                    {{ $submission->shippingAddress->country }}
                </div>

                <!-- Table -->
                <h3 style="color: #111827; font-size: 18px; margin: 0 0 15px 0; padding-bottom: 10px; border-bottom: 2px solid #e5e7eb;">Itemized List</h3>
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="text-align: left; color: #6B7280; font-size: 11px; text-transform: uppercase; padding: 10px 0; border-bottom: 1px solid #e5e7eb;">Card Details</th>
                            <th style="text-align: center; color: #6B7280; font-size: 11px; text-transform: uppercase; padding: 10px 0; border-bottom: 1px solid #e5e7eb; width: 60px;">Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($submission->card_entry_mode === 'detailed')
                            @foreach($submission->cards as $card)
                                <tr>
                                    <td style="padding: 12px 0; border-bottom: 1px solid #e5e7eb;">
                                        <div style="color: #111827; font-weight: 600; margin-bottom: 2px;">{{ $card->title }}</div>
                                        <div style="color: #6B7280; font-size: 13px;">{{ $card->set_name }} #{{ $card->card_number }}</div>
                                    </td>
                                    <td style="text-align: center; padding: 12px 0; border-bottom: 1px solid #e5e7eb; font-weight: bold; color: #A3050A;">{{ $card->qty }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td style="padding: 12px 0; border-bottom: 1px solid #e5e7eb;">
                                    <div style="color: #111827; font-weight: 600;">Bulk Submission (Easy Mode)</div>
                                    <div style="color: #6B7280; font-size: 13px;">Details not itemized by user.</div>
                                </td>
                                <td style="text-align: center; padding: 12px 0; border-bottom: 1px solid #e5e7eb; font-weight: bold; color: #A3050A;">{{ $submission->total_cards }}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                <div style="text-align: center; margin-top: 40px;">
                    <a href="{{ route('admin.submissions.show', $submission) }}" style="display: inline-block; padding: 14px 32px; background-color: #A3050A; color: #ffffff; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 15px; box-shadow: 0 4px 6px -1px rgba(163,5,10,0.2);">View Submission</a>
                </div>
            </div>
            
            <!-- Footer -->
            <div style="padding: 30px 20px; text-align: center; font-size: 13px; color: #9CA3AF; background-color: #f3f4f6; border-top: 1px solid #e5e7eb;">
                <p style="margin: 0;">&copy; {{ date('Y') }} {{ \App\Models\SiteSetting::get('site_name', 'Valen Grading') }}. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
