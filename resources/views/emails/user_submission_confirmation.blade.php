<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: 'Outfit', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; background-color: #f4f7f9; }
        .container { max-width: 600px; margin: 20px auto; padding: 20px; background-color: #ffffff; border-radius: 12px; border: 1px solid #e1e7eb; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .header { text-align: center; padding-bottom: 20px; border-bottom: 2px solid #f0f0f0; }
        .header h1 { color: #A3050A; margin: 0; font-size: 24px; text-transform: uppercase; letter-spacing: 1px; }
        .content { padding: 20px 0; }
        .details-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin: 20px 0; background-color: #f9fafb; padding: 15px; border-radius: 8px; }
        .detail-item { font-size: 14px; }
        .detail-label { font-weight: bold; color: #6b7280; display: block; text-transform: uppercase; font-size: 11px; margin-bottom: 4px; }
        .detail-value { color: #111827; font-weight: 600; }
        .card-list { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .card-list th { text-align: left; padding: 12px; background-color: #f3f4f6; font-size: 12px; color: #374151; border-bottom: 1px solid #e5e7eb; }
        .card-list td { padding: 12px; border-bottom: 1px solid #f3f4f6; font-size: 13px; }
        .footer { text-align: center; padding-top: 20px; font-size: 12px; color: #9ca3af; border-top: 1px solid #f0f0f0; margin-top: 20px; }
        .status-badge { display: inline-block; padding: 4px 12px; border-radius: 9999px; font-size: 12px; font-weight: 600; text-transform: uppercase; background-color: #def7ec; color: #03543f; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Submission Received</h1>
            <p>Thank you for choosing ValenGrading!</p>
        </div>
        
        <div class="content">
            <p>Hi {{ $submission->shippingAddress->full_name ?? $submission->user->name ?? 'Collector' }},</p>
            <p>We've received your submission <strong>#{{ $submission->submission_no }}</strong>. Our team is ready to provide the highest quality grading for your treasures.</p>

            <div class="details-grid">
                <div class="detail-item">
                    <span class="detail-label">Service Level</span>
                    <span class="detail-value">{{ $submission->serviceLevel->name }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Total Cards</span>
                    <span class="detail-value">{{ $submission->card_entry_mode === 'detailed' ? $submission->cards->sum('qty') : $submission->total_cards }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Payment Status</span>
                    <span class="status-badge">Paid</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Total Cost</span>
                    <span class="detail-value">€{{ number_format($submission->total_cost, 2) }}</span>
                </div>
            </div>

            <h3>Next Steps:</h3>
            <ol style="font-size: 14px; color: #4b5563; margin-bottom: 25px;">
                <li>Print your packing slip using the button below.</li>
                <li>Securely package your cards.</li>
                <li>Send them to the address mentioned on the packing slip.</li>
            </ol>

            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ route('submission.packingSlip.download', $submission->id) }}" style="display: inline-block; padding: 14px 28px; background-color: #A3050A; color: #ffffff; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 16px; box-shadow: 0 4px 6px rgba(163, 5, 10, 0.2);">Download Packing Slip</a>
            </div>

            @if($submission->card_entry_mode === 'detailed')
            <h3 style="margin-top: 30px; font-size: 16px; border-bottom: 1px solid #eee; padding-bottom: 10px;">Submitted Cards</h3>
            <table class="card-list">
                <thead>
                    <tr>
                        <th>Card Title</th>
                        <th>Set/Year</th>
                        <th>Qty</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($submission->cards as $card)
                    <tr>
                        <td>{{ $card->title }}</td>
                        <td>{{ $card->set_name }} {{ $card->year }}</td>
                        <td>{{ $card->qty ?? 1 }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} ValenGrading. All rights reserved.</p>
            <p>If you have any questions, please contact us at support@valengrading.com</p>
        </div>
    </div>
</body>
</html>
