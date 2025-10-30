<head>
    <title>Admin Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style_user.css') }}">
</head>

<body>
<div class="background-blur" style="background-image: url('{{ asset('asset/download.jpeg') }}');"></div>
    <div class="container-login">
        <h3>Admin Login</h3>

        @if (session('message'))
            <div class="alert alert-danger" role="alert">
                {{ session('message') }}
            </div>
        @endif
        

        <form action="{{ route('admin.login.submit') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
    </div>

</body>

@include('layouts.footer')