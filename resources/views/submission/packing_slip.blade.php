<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Packing Slip - {{ $submission->submission_no }}</title>
    <!-- Use html2pdf.js for clean PDF download without browser headers -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            color: #111;
            margin: 0;
            padding: 0;
            background: white;
        }
        
        #slip-content {
            padding: 40px;
            max-width: 800px;
            margin: 0 auto;
            background: white;
        }

        h1 {
            text-align: center;
            font-size: 28px;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-top: 0;
            font-weight: 700;
        }
        .top {
            border-bottom: 5px solid #222;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .fields {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-bottom: 20px;
        }
        .field-group {
            text-align: center;
            flex: 1;
        }
        .field {
            border: 1.5px solid #222;
            padding: 8px 5px;
            border-radius: 8px;
            min-width: 90px;
            text-align: center;
            font-weight: 700;
            font-size: 13px;
        }
        .field_label {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 6px;
        }
        .instructions {
            border-bottom: 5px solid #222;
            padding-top: 15px;
            padding-bottom: 25px;
            font-size: 13px;
            line-height: 1.5;
        }
        .cols {
            display: flex;
            justify-content: space-between;
            margin-top: 25px;
            line-height: 1.6;
        }
        .col { width: 45%; }
        .col-title { font-weight: 700; font-size: 14px; margin-bottom: 10px; }
        
        .no-print { display: none; }
    </style>
</head>
<body>
    <div id="slip-content">
        <div class="top">
            <h1>Packing Slip</h1>
            <div class="fields">
                <div class="field-group">
                    <p class="field_label">Submission No.</p>
                    <div class="field">{{ $submission->submission_no }}</div>
                </div>
                <div class="field-group">
                    <p class="field_label">Submission Date</p>
                    <div class="field">{{ $submission->created_at->format('d M Y') }}</div>
                </div>
                <div class="field-group">
                    <p class="field_label">No. of Cards</p>
                    <div class="field">{{ $submission->card_entry_mode === 'detailed' ? $submission->cards->sum('qty') : $submission->total_cards }}</div>
                </div>

                <div class="field-group">
                    <p class="field_label">Service Level</p>
                    <div class="field">{{ $submission->serviceLevel->name }}</div>
                </div>
                <div class="field-group">
                    <p class="field_label">Must Arrive By</p>
                    <div class="field">
                        {{ $submission->created_at->addMonth()->format('d M Y') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="instructions">
            <div style="text-align: center; margin-bottom: 15px;">
                <strong style="font-size: 15px; text-transform: uppercase;">Submission Instructions</strong>
            </div>
            <p>Please enclose this packing slip inside your securely packaged submission.</p>
            <p>if you do not have access to printer; handwrite following details on a sheet of paper:</p>
            <p style="margin-left: 10px;">• Full Name</p>
            <p style="margin-left: 10px;">• Submission Number</p>
            <p style="margin-left: 10px;">• Number of Cards Submitted</p>
            <p style="padding: 15px 0px"><strong>clearly mark your Submission Number on the outside of the parcel.</strong></p>
            <p>please visit your local Post Office or book a collection with your preferred courier to send Your cards to us</p>
        </div>

        <div class="cols">
            <div class="col">
                <p class="col-title">Send To</p>
                <p>Valen Grading</p>
                <p>123 Business Street</p>
                <p>London, EC1A 1BB</p>
                <p>United Kingdom</p>
            </div>
            <div class="col">
                <p class="col-title">Your Return Address</p>
                <p>{{ $submission->shippingAddress->full_name ?? $submission->guest_name }}</p>
                <p>{{ $submission->shippingAddress->address_line_1 ?? '-' }}</p>
                <p>{{ $submission->shippingAddress->city ?? '-' }}</p>
                <p>{{ $submission->shippingAddress->post_code ?? '' }}</p>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            // Add a small delay to ensure all fonts and layouts are stable before capture
            setTimeout(function() {
                const element = document.getElementById('slip-content');
                const opt = {
                    margin: 0,
                    filename: 'Packing-Slip-{{ $submission->submission_no }}.pdf',
                    image: { type: 'jpeg', quality: 0.98 },
                    html2canvas: { scale: 2, useCORS: true },
                    jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
                };

                html2pdf().set(opt).from(element).save();
            }, 800);
        }
    </script>
</body>
</html>
