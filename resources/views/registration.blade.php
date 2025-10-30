<head>
<title>User Registration</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style_user.css') }}">
    @section ('description', 'Join LastBites to discover quality food, enjoy discounts, and help reduce food waste. Supporting sustainability starts here')
    @section('keywords', 'food waste reduction', 'quality food', 'discounted meals', 'food surplus')
</head>

<body>
<div class="background-blur" style="background-image: url('{{ asset('asset/download.jpeg') }}');"></div>
    <div class="container-regis">
        <h3>Registration</h3>
        <form action="{{ route('register.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter your first name" value="{{ old('first_name') }}" required>
                @error('first_name') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter your last name" value="{{ old('last_name') }}" required>
                @error('last_name') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="example@gmail.com" value="{{ old('email') }}" required>
                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Create a password" required>
                @error('password') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" value="{{ old('phone') }}" required>
                @error('phone') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="gender">Gender:</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="">Select...</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>

            <div class="form-group">
                <label for="date_of_birth">Date of Birth:</label>
                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
            </div>

            <div class="form-group">
                <label for="user_role">Role:</label>
                <select class="form-control" id="user_role" name="user_role" onchange="toggleSIUP()" required>
                    <option value="">Select...</option>
                    <option value="Buyer">Buyer</option>
                    <option value="Seller">Seller</option>
                </select>
            </div>

            <div class="form-group" id="siup-group" style="display:none;">
                <label for="siup">SIUP Document:</label>
                <input type="file" class="form-control" id="siup" name="siup" accept=".pdf,.jpg,.png">
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
            <p class="mt-3"><a href="login">Already have an account?</a></p>
        </form>
    </div>

    @include('layouts.footer')

    <script>
        function toggleSIUP() {
            var role = document.getElementById("user_role").value;
            var siupField = document.getElementById("siup-group");
            if (role === "Seller") {
                siupField.style.display = "block";
            } else {
                siupField.style.display = "none";
            }
        }
    </script>    
</body>