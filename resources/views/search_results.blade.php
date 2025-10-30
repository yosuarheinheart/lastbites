<head>
    <title>Search Results - LastBites</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link href="{{ asset('css/style_search_results.css') }}" rel="stylesheet">
</head>

<body>
    @include('layouts.nav')

    <div class="container mt-4">
        <form action="{{ route('search') }}" method="GET" class="mb-4">
            <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search for products or stores" required>
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>

            <h2>Search Results for "{{ $keyword }}"</h2>
            
            <div class="list-group">
                @if ($stores->isNotEmpty())
                    @foreach ($stores as $store)
                        <a href="{{ url('store/' . $store->store_id) }}" class="list-group-item {{ $store->status === 'Inactive' ? 'inactive' : '' }}">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset($store->store_picture) }}"
                                    alt="Store Picture"
                                    class="img-thumbnail mr-3"
                                    style="width: 100px; height: 100px; object-fit: cover;">
                                <div>
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
                    <p class="text-muted">No stores found matching your search criteria.</p>
                @endif
            </div>
        </div>
        
    @include('layouts.footer')
</body>