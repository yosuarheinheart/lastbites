<style>
    .rating-container {
    display: flex;
    align-items: center;
}

.rating-text {
    margin-right: 10px; 
}

.stars {
    display: flex;
    justify-content: flex-start; 
}

.stars input[type="radio"] {
    display: none;
}

.stars label {
    font-size: 24px; 
    color: #ddd; 
    cursor: pointer;
}

.stars input[type="radio"]:checked ~ label {
    color: #f39c12; 
}


.btn-primary {
    background-color: #006b5e !important;
    border:none !important;
    padding:10px 15px !important;
    border-radius: 4px !important;
    font-size: 14px !important;
    cursor: pointer !important;
}

</style>
<head>
    <br>
    <title>Transaction History</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFX0dJZ4" crossorigin="anonymous">        <link href="css/style_nav.css" rel="stylesheet">
    <link href="{{ asset('css/style_history.css') }}" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

</head>

<body>
    @include('layouts.nav')

    <div class="container">
        <br>
        
        <h1 data-aos="fade-down" data-aos-duration="500">Transaction History</h1>
    
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
    
        @if ($transactions->isNotEmpty())
            @foreach ($transactions as $transaction)
                <div data-aos="zoom-in" data-aos-duration="500" class="card mb-4">
                    <div data-aos="zoom-in" data-aos-duration="500" class="card-body">
                        <h3>{{ $transaction->store_name }}</h3>
                        <p><strong>Address:</strong> {{ $transaction->address }}</p>
                        <p><strong>Transaction Date:</strong> {{ $transaction->transaction_date }}</p>
                        <p><strong>Total Amount:</strong> Rp {{ number_format($transaction->total_amount, 2, ',', '.') }}</p>
                        <p><strong>Status:</strong> {{ $transaction->payment_status }}</p>
    
                        <p><strong>Products:</strong></p>
                        <ul>
                            @foreach ($products_map[$transaction->transaction_id] ?? [] as $product)
                                <li>{{ $product->product_name }} (Quantity: {{ $product->quantity }})</li>
                            @endforeach
                        </ul>
    
                        @if ($transaction->payment_status === 'completed')
                            @php $existingReview = $reviews_map[$transaction->transaction_id] ?? null; @endphp
    
                            @if ($existingReview)
                                <p><strong>Your Rating:</strong> {{ str_repeat('★', $existingReview->rating) . str_repeat('☆', 5 - $existingReview->rating) }}</p>
                                <p><strong>Your Review:</strong> {{ $existingReview->review }}</p>
                            @else
                                <form action="{{ route('history.rate') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="transaction_id" value="{{ $transaction->transaction_id }}">
                                    <input type="hidden" name="user_id" value="{{ Session::get('user_id') }}">
                                    <input type="hidden" name="product_id" value="{{ $products_map[$transaction->transaction_id][0]->product_id }}">
    
                                    <p><strong>Rate this transaction:</strong></p>
                                    <div class="rating">
    @if ($existingReview)
        <div>
            @php $rating = $existingReview->rating; @endphp
            <div class="stars">
                @for ($i = 1; $i <= 5; $i++)
                    <span class="{{ $i <= $rating ? 'star-filled' : 'star' }}">&#9733;</span>
                @endfor
            </div>
        </div>
        <p><strong>Your Review:</strong> {{ $existingReview->review }}</p>
    @else
        <form action="{{ route('history.rate') }}" method="POST">
            @csrf
            <input type="hidden" name="transaction_id" value="{{ $transaction->transaction_id }}">
            <input type="hidden" name="user_id" value="{{ Session::get('user_id') }}">
            <input type="hidden" name="product_id" value="{{ $products_map[$transaction->transaction_id][0]->product_id }}">

            <div class="rating-container">
                <div class="stars">
                    <input type="radio" id="star-5-{{ $transaction->transaction_id }}" name="rating" value="5">
                    <label for="star-5-{{ $transaction->transaction_id }}">&#9733;</label>
                    <input type="radio" id="star-4-{{ $transaction->transaction_id }}" name="rating" value="4">
                    <label for="star-4-{{ $transaction->transaction_id }}">&#9733;</label>
                    <input type="radio" id="star-3-{{ $transaction->transaction_id }}" name="rating" value="3">
                    <label for="star-3-{{ $transaction->transaction_id }}">&#9733;</label>
                    <input type="radio" id="star-2-{{ $transaction->transaction_id }}" name="rating" value="2">
                    <label for="star-2-{{ $transaction->transaction_id }}">&#9733;</label>
                    <input type="radio" id="star-1-{{ $transaction->transaction_id }}" name="rating" value="1">
                    <label for="star-1-{{ $transaction->transaction_id }}">&#9733;</label>
                </div>
            </div>

            <textarea name="review" rows="3" placeholder="Write your review here..." required></textarea>
            <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>
    @endif
</div>

  @endif
@endif
                    </div>
                </div>
            @endforeach
        @else
            <p>No transactions found.</p>
        @endif
    </div>
    
    @include('layouts.footer')
</body>

<script>
    AOS.init({
    once: true,
    });
</script>