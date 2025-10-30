<head>
    <title>Create Store</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFX0dJZ4" crossorigin="anonymous">
    <link href="{{ asset('css/style_store_create.css') }}" rel="stylesheet">
</head>

<body>
@include('layouts.nav')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <h3>Create Your Store</h3>

        @if (session('message'))
            <p class="alert alert-success">{{ session('message') }}</p>
        @endif

        <form action="{{ route('store.create') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="store_name">Store Name:</label>
                <input type="text" class="form-control" id="store_name" name="store_name" required>
            </div>

            <div class="form-group">
                <label for="store_description">Store Description:</label>
                <textarea class="form-control" id="store_description" name="store_description" required></textarea>
            </div>

            <div class="form-group">
                <label for="address">Address:</label>
                <textarea class="form-control" id="address" name="address" required></textarea>
            </div>

            <div class="form-group">
                <label for="store_picture">Store Picture:</label>
                <input type="file" class="form-control-file" id="store_picture" name="store_picture">
            </div>
        
            <div class="form-group text-center">
                <button type="submit" class="btn btn-save">Create Store</button>
            </div>
        </form>
    </div>

@include('layouts.footer')
</body>