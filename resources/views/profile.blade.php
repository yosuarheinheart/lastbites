<head>
    <title>Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link href="{{ asset('css/style_profile.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
    function enableEditMode() {
        document.getElementById('profile-form').style.display = 'block';
        document.getElementById('edit-button').style.display = 'none';
        document.getElementById('display-info').style.display = 'none';
    }
    </script>
</head>

<body>
@include('layouts.nav')

    <div class="container">
        <h2 data-aos="fade-down" data-aos-duration="750">Profile Information</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div data-aos="zoom-in" data-aos-duration="500" class="card p-4">
                <img data-aos="fade-right" data-aos-duration="500" 
                src="{{ asset($user->profile_picture) }}" alt="Profile Picture" class="rounded-circle profile mb-3" width="100" height="100">
                <div data-aos="fade-right" data-aos-duration="1000">
                    <div class="user-detail">
                        <p><strong>First Name</strong>: {{ $user->first_name }}</p>
                        <p><strong>Last Name</strong>: {{ $user->last_name }}</p>
                        <p><strong>Email</strong>: {{ $user->email }}</p>
                        <p><strong>Phone</strong>: {{ $user->phone }}</p>
                        <p><strong>Gender</strong>: {{ $user->gender }}</p>
                        <p><strong>Date of Birth</strong>: {{ $user->date_of_birth }}</p>
                    </div>
                </div>

            <button id="edit-button" class="btn btn-warning" onclick="enableEditMode()">Edit Profile</button>
        </div>

        <div id="profile-form" class="card p-4" style="display: none;">
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="profile_picture">Profile Picture</label>
                    <input type="file" class="form-control-file" id="profile_picture" name="profile_picture">
                </div>
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-warning">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

</body>
<script>
    AOS.init({
    once: true,
    });
</script>
