<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFX0dJZ4" crossorigin="anonymous">
    <title>Store Management</title>
    <link href="{{ asset('css/style_store_management.css') }}" rel="stylesheet">
</head>

<body>
    @include('layouts.nav')

    <div class="sidebar">
        <a href="#" onclick="showSection('storeForm')">Edit Store</a>
        <a href="#" onclick="showSection('productForm')">Add Product</a>
        <a href="#" onclick="showSection('manageProducts')">Manage Products</a>
        <a href="#" onclick="showSection('manageTransactions')">Manage Transactions</a>
    </div>

    <div class="content">
        <div id="storeForm">
            <div class="message">
                @if(session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                @endif
            </div>

            <h2>Edit Store Information</h2>
            <form action="{{ route('store.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="store_id" value="{{ $store->store_id }}">
                <div class="form-group mb-3">
                    <label for="store_picture">Store Picture</label>
                    <input type="file" class="form-control" id="store_picture" name="store_picture" accept="image/*">
                    <img src="{{ asset($store->store_picture) }}" alt="Store Picture" width="150">
                </div>
                <div class="form-group mb-3">
                    <label for="store_name">Store Name</label>
                    <input type="text" class="form-control" id="store_name" name="store_name" value="{{ $store->store_name }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="store_description">Store Description</label>
                    <textarea class="form-control" id="store_description" name="store_description" required>{{ $store->store_description }}</textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="store_address">Store Address</label>
                    <input type="text" class="form-control" id="store_address" name="store_address" value="{{ $store->address }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="store_status">Store Status</label>
                    <select class="form-control" id="store_status" name="store_status" required>
                        <option value="Active" {{ $store->status == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Inactive" {{ $store->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <button type="submit" name="update_store" class="btn btn-update-store">Update Store</button>
            </form>
        </div>

        <div id="productForm" style="display: none;">
            <div class="message">
                @if(session('message_add_product'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message_add_product') }}
                    </div>
                @endif
            </div>

            <h2>Add New Product</h2>
            <form action="{{ route('product.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="product_picture">Product Picture</label>
                    <input type="file" class="form-control" id="product_picture" name="product_picture" accept="image/*">
                </div>
                <div class="form-group mb-3">
                    <label for="product_name">Product Name</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" required>
                </div>
                <div class="form-group mb-3">
                    <label for="category_id">Category</label>
                    <select class="form-control" id="category_id" name="category_id" required>
                        <option value="">Select...</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="product_description">Product Description</label>
                    <textarea class="form-control" id="product_description" name="product_description" required></textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="price" min="1000" required>
                </div>
                <div class="form-group mb-3">
                    <label for="stock">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" min="0" required>
                </div>
                <div class="form-group mb-3">
                    <label for="product_status">Product Status</label>
                    <select class="form-control" id="product_status" name="product_status" required>
                        <option value="">Select...</option>
                        <option value="Available">Available</option>
                        <option value="Out of Stock">Out of Stock</option>
                    </select>
                </div>
                <button type="submit" name="add_product" class="btn btn-add-product">Add Product</button>
            </form>
        </div>

        <div id="manageProducts" style="display: none;">
            <div class="message">
                @if(session('message_manage_product'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message_manage_product') }}
                    </div>
                @endif
            </div>

            <h2>Manage Products</h2>
            @if($products->isEmpty())
                <p class="text-muted">No products available in the store. Add some products to get started!</p>
            @else
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <img src="{{ asset(asset($product->product_picture)) }}" class="card-img-top" alt="Product Image">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->product_name }}</h5>
                                    <p class="card-text">Description: {{ $product->product_description }}</p>
                                    <p class="card-text">Stock: {{ $product->stock }}</p>
                                    <p class="card-text">Status: {{ $product->status }}</p>
                                    
                                    <div class="d-flex justify-content-between">
                                        <form method="get" action="{{ route('product.edit', $product->product_id) }}">
                                            <button type="submit" class="btn btn-edit">Edit</button>
                                        </form>
                                        
                                        <form method="post" action="{{ route('product.delete', $product->product_id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-delete">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div id="manageTransactions" style="display: none;">
            <div class="message">
                @if(session('message_transaction'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message_transaction') }}
                    </div>
                @endif
            </div>

            <h3>Manage Transactions</h3>
            
            @if($transactions->isEmpty())
                <p class="text-muted">No transactions available for this store at the moment.</p>
            @else
                <div class="row">
                    @foreach ($transactions as $transaction)
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">User: {{ $transaction->first_name }} {{ $transaction->last_name }}</h5>
                                    <p class="card-text">Total Amount: Rp.{{ $transaction->total_amount }}</p>

                                    <h6>Products:</h6>
                                    <ul>
                                    @foreach ($transaction_items[$transaction->transaction_id] as $item)
                                        <li>{{ $item->product_name }} (Quantity: {{ $item->quantity }}, Price: Rp. {{ $item->price }})</li>
                                    @endforeach
                                    </ul>

                                    <form method="post" action="{{ route('transaction.update') }}">
                                        @csrf
                                        <input type="hidden" name="transaction_id" value="{{ $transaction->transaction_id }}">
                                        <div class="form-group">
                                            <select class="form-control" name="payment_status" required>
                                                <option value="">Pending</option>
                                                <option value="Completed" {{ $transaction->payment_status === 'Completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="Failed" {{ $transaction->payment_status === 'Failed' ? 'selected' : '' }}>Failed</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <script>
        function showSection(sectionId) {
            document.getElementById('storeForm').style.display = 'none';
            document.getElementById('productForm').style.display = 'none';
            document.getElementById('manageProducts').style.display = 'none';
            document.getElementById('manageTransactions').style.display = 'none';

            document.getElementById(sectionId).style.display = 'block';
        }

        document.addEventListener("DOMContentLoaded", function() {
            const section = window.location.hash ? window.location.hash.substring(1) : 'storeForm';
            showSection(section);
        });
    </script>

    @include('layouts.footer')
</body>