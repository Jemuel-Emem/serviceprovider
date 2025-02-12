<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            text-align: center;
        }
        .receipt-container {
            border: 1px solid #ddd;
            padding: 20px;
            max-width: 400px;
            margin: auto;
        }
        .receipt-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .receipt-details {
            text-align: left;
        }
        .receipt-footer {
            margin-top: 20px;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <h2 class="receipt-title">Service Receipt</h2>
        <hr>
        <div class="receipt-details">
            <p><strong>Client:</strong> {{ $appointment->clientname }}</p>
            <p><strong>Service:</strong> {{ $appointment->servicename }}</p>
            <p><strong>Price:</strong> Php{{ number_format($appointment->price, 2) }}</p>
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->dateofappointment)->format('F j, Y') }}</p>
            <p><strong>Method of Payment:</strong> {{ ucfirst($appointment->mop) }}</p>
            @if($appointment->gcashreceipt)
                <p><strong>GCash Receipt:</strong> <a href="{{ asset('storage/' . $appointment->gcashreceipt) }}" target="_blank">View</a></p>
            @else
                <p><strong>Payment Mode:</strong> Walk-in</p>
            @endif
        </div>
        <hr>
        <div class="receipt-footer">
            <p>Thank you for your appointment!</p>
        </div>
    </div>
</body>
</html>
