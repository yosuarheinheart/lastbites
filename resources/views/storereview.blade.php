<style>
.btn-secondary {
        background-color: #3f786c !important;
        color: #fff;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .btn-secondary i {
        font-size: 16px;
    }

    .btn-secondary:hover {
        background-color: #006b5e !important;
    }
</style>
<head>
    <title>All Reviews - {{ $store->store_name }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFX0dJZ4" crossorigin="anonymous">
    <link href="{{ asset('css/style_rv.css') }}" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

</head>
    
<body>
    @include('layouts.nav')
    
    <div class="container mt-4">

    <div class="mb-3" data-aos="fade-up" data-aos-duration="1000">
        <a href="{{ route('store.view', ['store_id' => $store->store_id]) }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Store
        </a>
    </div>
        <h2 data-aos="fade-right" data-aos-duration="1000">All Reviews for {{ $store->store_name }}</h2>
        @if ($allReviews->isNotEmpty())
            @foreach ($allReviews as $review)
                <div data-aos="zoom-in" data-aos-duration="1000" class="review border p-3 mb-2 rounded">
                    <div class="review-header">
                        {{ $review->first_name }} {{ $review->last_name }}
                    </div>
                    <div class="review-details">
                        <span class="star-rating">
                            @for ($i = 0; $i < $review->rating; $i++)
                                <span style="color: #ffc107;">★</span>
                            @endfor
                            @for ($i = $review->rating; $i < 5; $i++)
                                <span style="color: #ddd;">☆</span>
                            @endfor
                        </span>
                        <span class="ml-2">{{ \Carbon\Carbon::parse($review->review_date)->format('j F Y') }}</span>
                        <br>
                        <span>Product: {{ $review->product_name }}</span>
                    </div>
                    <p class="mt-2">{{ $review->review }}</p>
                </div>
            @endforeach
        @else
            <p>No reviews yet. Be the first to review this store!</p>
        @endif
    </div>
    @include('layouts.footer')
</body>
<script>
    AOS.init({
    once: true,
    });
</script>