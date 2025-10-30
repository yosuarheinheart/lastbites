<head>
<title>User Registration</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style_product_update.css') }}">
</head>

<body>
    @include('layouts.nav')

    <main class="container">
        <br>
        <h2>Edit Product - {{ $product->product_name }}</h2>
        <div id="product-form" class="card p-4">
            <a href="{{ route('store.management') }}" class="back-button">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 18L9 12L15 6" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>Back</span>
            </a>
            
            <form method="POST" action="{{ route('product.update', $product->product_id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="product_picture">Product Picture</label>
                    <input type="file" class="form-control-file" id="product_picture" name="product_picture">
                    @if ($product->product_picture)
                        <img src="{{ asset($product->product_picture) }}" alt="Product Image" width="150">
                    @endif
                </div>

                <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" value="{{ $product->product_name }}" required>
                </div>

                <div class="form-group">
                    <label for="product_description">Description</label>
                    <textarea class="form-control" id="product_description" name="product_description" required>{{ $product->product_description }}</textarea>
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
                </div>

                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="{{ $product->stock }}" required>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="Available" {{ $product->status === 'Available' ? 'selected' : '' }}>Available</option>
                        <option value="Out of Stock" {{ $product->status === 'Out of Stock' ? 'selected' : '' }}>Out of Stock</option>
                    </select>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary w-100">Update Product</button>
                </div>
            </form>
        </div>
    </main>
    
    @include('layouts.footer')
</body>