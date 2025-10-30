<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Success - LastBites</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        .container {
            text-align: center;
            background: #ffffff;
            padding: 100px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .container h2 {
            color: #28a745;
        }
        .container p {
            margin: 10px 0;
            color: #333;
        }
        .btn {
            background-color: #F3D457;
            color: #344b46;
            border: none;
            border-radius: 4px;
            padding: 10px 15px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn:hover {
            background-color: #af9e69;
            color: #fff;
            transform: scale(1.05);
        }

        .btn:active {
            background-color: #af9e69; 
            transform: scale(0.95);
        }
    </style>
</head>
<body>

    @include('layouts.nav')

    <div class="container mt-5">
        <h2>🎉 Transaction Successful!</h2>
        <p>Your order has been successfully placed. Please visit the following store to collect your order:</p>
        <p><strong>Store Name:</strong> {{ $transaction->store_name }}</p>
        <p><strong>Store Address:</strong> {{ $transaction->address }}</p>
        <p><strong>Transaction Date:</strong> {{ \Carbon\Carbon::parse($transaction->transaction_date)->format('F j, Y, g:i a') }}</p>
        <a href="{{ route('home.view') }}" class="btn">Back to Home</a>
    </div>

    @include('layouts.footer')
</body>
</html>