<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .receipt {
            width: 500px;
            background-color: #fff;
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h2 {
            font-size: 24px;
            color: #333;
            margin: 0;
        }
        .header p {
            font-size: 14px;
            color: #777;
            margin: 5px 0 0;
        }
        .details {
            margin-top: 20px;
        }
        .details p {
            margin: 10px 0;
            font-size: 16px;
            color: #555;
        }
        .details p strong {
            color: #333;
            font-weight: 600;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="header">
            <h2>Receipt</h2>
            <p>Thank you for your appointment!</p>
        </div>
        <div class="details">
            <p><strong>Client Name:</strong> {{ $appointment->clientname }}</p>
            <p><strong>Service Name:</strong> {{ $appointment->servicename }}</p>
            <p><strong>Price:</strong> Php{{ number_format($appointment->price, 2) }}</p>
            <p><strong>Date of Appointment:</strong> {{ \Carbon\Carbon::parse($appointment->dateofappointment)->format('F j, Y') }}</p>
            <p><strong>Method of Payment:</strong> {{ ucfirst($appointment->mop) }}</p>
        </div>
        <div class="footer">
            <p>If you have any questions, please contact us.</p>
            <p>© 2025 Your Company Name. All rights reserved.</p>
        </div>
    </div>
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
