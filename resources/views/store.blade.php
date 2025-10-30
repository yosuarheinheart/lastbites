<head>
    <title>{{ $store->store_name }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFX0dJZ4" crossorigin="anonymous">
    <link href="{{ asset('css/style_store.css') }}" rel="stylesheet">
</head>

<body>
    @include('layouts.nav')

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset($store->store_picture) }}" alt="Store Picture" class="img-fluid rounded">
            </div>
            <div class="col-md-8">
                <h2>{{ $store->store_name }}</h2>
                <p>Address: {{ $store->address }}</p>
                <p>Status: 
                    @if($store->status === 'Inactive')
                        <span class="badge badge-danger">Closed</span>
                    @else
                        <span class="badge badge-success">Open</span>
                    @endif
                </p>
                <p>Description: {{ $store->store_description }}</p>
                <a href="{{ route('chat.view', ['receiver_id' => $store->user_id]) }}" class="btn btn-chat mt-2">Chat with Seller</a>
            </div>
        </div>

        <div class="mt-4">
            <h3>Overall Rating: {{ isset($ratingData->average_rating) ? number_format($ratingData->average_rating, 2) : '-' }}/5.00
                @if(!empty($ratingData->review_count))
                    ({{ $ratingData->review_count }} reviews)
                @endif
            </h3>
            <h4 class="mt-3">Reviews</h4>
            @if ($reviews->isNotEmpty())
                @foreach($reviews as $review)
                    <div class="review border p-3 mb-2 rounded">
                        <p>
                            <strong>Rating:</strong>
                            @for ($i = 0; $i < $review->rating; $i++)
                                <span style="color: #ffc107;">★</span>
                            @endfor
                            @for ($i = $review->rating; $i < 5; $i++)
                                <span style="color: #ddd;">☆</span>
                            @endfor
                        </p>
                        <p>{{ $review->review }}</p>
                    </div>
                @endforeach

                <a href="{{ route('store.allReviews', ['store_id' => $store_id]) }}" class="btn btn-link">View All Reviews</a>
            @else
                <p>No reviews yet. Be the first to review this store!</p>
            @endif
        </div>

        <div class="mt-4">
            <h3>Products</h3>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('warning'))
                <div class="alert alert-warning">
                    {{ session('warning') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-4 mb-3">
                        <div class="card {{ $store->status === 'Inactive' ? 'inactive' : '' }}">
                            <img src="{{ asset($product->product_picture) }}" class="card-img-top" alt="Product Image">
                            <div class="card-body">
                                <h5 class="card-title"><strong>{{ $product->product_name }}</strong></h5>
                                <p class="card-text">Price: Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                                <p class="card-text">Description: {{ $product->product_description }}</p>
                                <div class="d-flex justify-content-between">
                                    @if ($store->status === 'Active')
                                        <form method="POST" action="{{ route('cart.add') }}">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                            <input type="hidden" name="store_id" value="{{ $store_id }}">
                                            <button type="submit" class="btn btn-add">Add to Cart</button>
                                        </form>
                                        @if (in_array($product->product_id, $cartItems)) 
                                            <form method="POST" action="{{ route('cart.remove') }}" class="mr-2">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                                <input type="hidden" name="store_id" value="{{ $store_id }}">
                                                <button type="submit" class="btn btn-remove">Remove from Cart</button>
                                            </form>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @if ($cartItemCount > 0)
            <div class="floating-cart-button">
                <a href="{{ route('transaction.view') }}" class="btn btn-cart">
                    Cart ({{ $cartItemCount }})
                </a>
            </div>
        @endif
    </div>

    @if(session('cart_alert'))
        <script>
            let userResponse = confirm("{{ session('cart_alert')['message'] }}");
            if (userResponse) {
                window.location.href = "{{ url('cart/clear') }}"; 
            } else {
                window.location.href = "{{ url('home') }}"; 
            }
        </script>
    @endif

   
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const forms = document.querySelectorAll("form");
            forms.forEach(form => {
                form.addEventListener("submit", function() {
                    localStorage.setItem("scrollPosition", window.scrollY);
                });
            });

            const scrollPosition = localStorage.getItem("scrollPosition");
            if (scrollPosition) {
                window.scrollTo(0, parseInt(scrollPosition, 10));
                localStorage.removeItem("scrollPosition");
            }
        });
    </script>

@include('layouts.footer')

</body>