<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Transaction - LastBites</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFX0dJZ4" crossorigin="anonymous">
        <link href="{{ asset('css/style_footer.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style_transaction.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style_nav.css') }}" rel="stylesheet">
    </head>

    <body>
        @include('layouts.nav')

        <div class="container mt-4">
            <a href="javascript:history.back()" class="back-button">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 18L9 12L15 6" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>Back</span>
            </a>

            <h2>Your Cart</h2>

            @if($cartItems->isNotEmpty())
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $item)
                            <tr>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ 'Rp. ' . number_format($item->price, 0, ',', '.') }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ 'Rp. ' . number_format($item->total_price, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <h4>Total Cost: {{ 'Rp. ' . number_format($totalCost, 0, ',', '.') }}</h4>

                <form method="POST" action="{{ route('transaction.process') }}">
                    @csrf
                    <div class="alert alert-danger" role="alert" style="font-weight: bold; color:red;">
                        Note: Payment is made directly at the store when you pick up your food.
                    </div>

                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <button type="submit" class="btn btn-payment">Proceed to Payment</button>
                </form>
            @else
                <p>Your cart is empty. <a href="{{ route('home.view') }}">Go back to Shopping</a>.</p>
            @endif
        </div>
        
        @include('layouts.footer')
    </body>
</html>
