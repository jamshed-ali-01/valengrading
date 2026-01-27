<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Submission Received</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #15171A; color: #ffffff; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 20px auto; background-color: #232528; border-radius: 16px; overflow: hidden; border: 1px solid rgba(255,255,255,0.05); }
        .header { background: linear-gradient(to right, #A3050A, #6e0306); padding: 40px 20px; text-align: center; }
        .header h1 { margin: 0; font-size: 24px; font-weight: bold; text-transform: uppercase; letter-spacing: 2px; }
        .content { padding: 30px; }
        .info-box { background-color: #15171A; border-radius: 12px; padding: 20px; margin-bottom: 20px; border: 1px solid rgba(255,255,255,0.1); }
        .label { color: #888888; font-size: 12px; text-transform: uppercase; font-weight: bold; margin-bottom: 4px; }
        .value { color: #ffffff; font-size: 16px; font-weight: 500; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th { text-align: left; color: #888888; font-size: 11px; text-transform: uppercase; padding: 10px; border-bottom: 1px solid rgba(255,255,255,0.05); }
        .table td { padding: 10px; border-bottom: 1px solid rgba(255,255,255,0.05); font-size: 14px; }
        .qty { font-weight: bold; color: #A3050A; }
        .footer { padding: 20px; text-align: center; font-size: 12px; color: #555555; background-color: #1C1E22; }
        .button { display: inline-block; padding: 12px 24px; background-color: #A3050A; color: #ffffff; text-decoration: none; border-radius: 8px; font-weight: bold; margin-top: 20px; }
        .highlight { color: #A3050A; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 style="color: white; margin: 0;">New Order Received</h1>
        </div>
        <div class="content">
            <p style="font-size: 16px; line-height: 1.6;">Hello Admin, a new grading submission <span class="highlight">#{{ $submission->submission_no }}</span> has been paid and received.</p>
            
            <div class="info-box">
                <div style="display: flex; justify-content: space-between; flex-wrap: wrap;">
                    <div style="width: 48%; margin-bottom: 15px;">
                        <div class="label">Customer</div>
                        <div class="value">{{ $submission->guest_name ?? $submission->user->name }}</div>
                    </div>
                    <div style="width: 48%; margin-bottom: 15px;">
                        <div class="label">Total Amount</div>
                        <div class="value">€{{ number_format($submission->total_cost, 2) }}</div>
                    </div>
                    <div style="width: 48%;">
                        <div class="label">Service Level</div>
                        <div class="value">{{ $submission->serviceLevel->name }}</div>
                    </div>
                    <div style="width: 48%;">
                        <div class="label">Total Cards</div>
                        <div class="value">{{ $submission->card_entry_mode === 'detailed' ? $submission->cards->sum('qty') : $submission->total_cards }}</div>
                    </div>
                </div>
            </div>

            <h3 style="color: #ffffff; border-bottom: 1px solid #A3050A; padding-bottom: 5px; margin-top: 30px;">Shipping Summary</h3>
            <p style="font-size: 14px; color: #cccccc; line-height: 1.5;">
                {{ $submission->shippingAddress->full_name }}<br>
                {{ $submission->shippingAddress->address_line_1 }}<br>
                @if($submission->shippingAddress->address_line_2) {{ $submission->shippingAddress->address_line_2 }}<br> @endif
                {{ $submission->shippingAddress->city }}, {{ $submission->shippingAddress->post_code }}<br>
                {{ $submission->shippingAddress->country }}
            </p>

            <h3 style="color: #ffffff; border-bottom: 1px solid #A3050A; padding-bottom: 5px; margin-top: 30px;">Itemized List</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 70%;">Card Details</th>
                        <th style="text-align: center;">Qty</th>
                    </tr>
                </thead>
                <tbody>
                    @if($submission->card_entry_mode === 'detailed')
                        @foreach($submission->cards as $card)
                            <tr>
                                <td>
                                    <strong>{{ $card->title }}</strong><br>
                                    <span style="font-size: 12px; color: #888888;">{{ $card->set_name }} #{{ $card->card_number }}</span>
                                </td>
                                <td style="text-align: center;" class="qty">{{ $card->qty }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>
                                <strong>Bulk Submission (Easy Mode)</strong><br>
                                <span style="font-size: 12px; color: #888888;">Details not itemized by customer.</span>
                            </td>
                            <td style="text-align: center;" class="qty">{{ $submission->total_cards }}</td>
                        </tr>
                    @endif
                </tbody>
            </table>

            <div style="text-align: center;">
                <a href="{{ route('admin.submissions.show', $submission) }}" class="button shadow-lg">View Submission in Admin Panel</a>
            </div>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} {{ \App\Models\SiteSetting::get('site_name', 'Valen Grading') }}. All rights reserved.
        </div>
    </div>
</body>
</html>
