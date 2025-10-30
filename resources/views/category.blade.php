<head>
    <title>Category</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFX0dJZ4" crossorigin="anonymous">
    <link href="{{ asset('css/style_category_stores.css') }}" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

</head>

<body>
    @include('layouts.nav')

    <div data-aos="fade-down" data-aos-duration="500" class="container mt-4 mt-5">
        <h2>{{ $categoryName }} Stores</h2>
        
        <div data-aos="zoom-in" data-aos-duration="500" class="list-group">
            @if ($stores->isNotEmpty())
                @foreach ($stores as $store)
                    <a href="{{ route('store.view', ['store_id' => $store->store_id]) }}" class="list-group-item {{ $store->status === 'Inactive' ? 'inactive' : '' }}">
                        <div class="d-flex align-items-center">
                            <img data-aos="fade-right" data-aos-duration="1000" data-aos-delay="500" 
                                src="{{ asset($store->store_picture) }}" 
                                alt="Store Picture" 
                                class="img-thumbnail mr-3"
                                style="width: 100px; height: 100px; object-fit: cover;">
    
                            <div data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="500">
                                <h5 class="mb-1">
                                    {{ $store->store_name }}
                                    @if ($store->status === 'Inactive')
                                          <span class="badge badge-danger ml-2">Closed</span>
                                    @endif
                                </h5>
                                <p class="mb-1">Location: {{ $store->address }}</p>
                                @if ($store->average_rating > 0)
                                    <small>Rating: {{ $store->average_rating }}/5.00</small>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            @else
                <p class="text-muted">No stores found in this category.</p>
            @endif
        </div>
    </div>    
    
    @include('layouts.footer')
</body>

<script>
    AOS.init({
    once: true,
    });
</script>