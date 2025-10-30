<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style_user.css') }}">
</head>

<body>
<div class="background-blur" style="background-image: url('{{ asset('asset/download.jpeg') }}');"></div>
    <div class="container-login">
        <h3>Log In</h3>

        @if (session('message_regis'))
            <div class="alert alert-success" role="alert">
                {{ session('message_regis') }}
            </div>
        @endif
        
        @if (session('message'))
            <div class="alert alert-danger" role="alert">
                {{ session('message') }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" maxlength="60" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" maxlength="20" required>
            </div>
            <button type="submit" class="btn">Login</button>
            <p class="mt-3"><a href="{{ route('register.view') }}">Don't have an account?</a></p>
        </form>
    </div>
    
    @include('layouts.footer')
</body>