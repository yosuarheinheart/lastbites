<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link href="{{ asset('css/style_nav.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <meta name="description" content="@yield('description', 'Join LastBites to discover quality food, enjoy discounts, and help reduce food waste. Supporting sustainability starts here')">
        <meta name="keywords home" content="@yield('keywords', 'food waste reduction', 'quality food', 'discounted meals', 'food surplus')">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home.view') }}">
                <img src="{{ asset('asset/logo.png') }}" alt="Logo" width="50" height="50" class="d-inline-block align-top mr-2">
                LastBites
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item nav-home">
                        <a class="nav-link" href="{{ route('home.view') }}">Home</a>
                    </li>
                    <li class="nav-item nav-chat">
                        <a class="nav-link" href="{{ route('chat.history') }}">Chat</a>
                    </li>
                    <li class="nav-item nav-history">
                        <a class="nav-link" href="{{ route('history.view') }}">History</a>
                    </li>
                    <li class="nav-item nav-about">
                    <a class="nav-link scroll-to-section" href="{{ route('home.view') }}#about">About Us</a>
                    </li>
                    @if ($isSeller)
                        @if (!$ownStore)
                            <li>
                                <a class="nav-link" href="{{ route('store.create.form') }}">Create Store</a>
                            </li>
                        @endif
                    @endif 
                    <li class="nav-item dropdown nav-profile">
                        <a class="nav-link" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ asset($user->profile_picture) }}" alt="Profile Picture" class="rounded-circle" width="30" height="30">
                        </a> 
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                            <a class="dropdown-item nav-dropdown-item" href="{{ route('profile.show') }}">Profile</a>
                            
                            @if ($isSeller)
                                @if ($ownStore)
                                    <a class="dropdown-item nav-dropdown-item" href="{{ route('store.management') }}">Manage Store</a>
                                @endif
                            @endif
                            <a class="dropdown-item nav-dropdown-item" href="{{ route('logout.view') }}">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <script>
    document.querySelectorAll('.scroll-to-section').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const currentUrl = window.location.href.split('#')[0];
            const targetUrl = this.href.split('#')[0];

            if (currentUrl === targetUrl) {
                // Jika sudah di halaman yang sama, lakukan smooth scroll
                e.preventDefault();
                const targetId = this.getAttribute('href').split('#')[1];
                const targetElement = document.getElementById(targetId);

                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            } else {
                // Biarkan default behavior (navigasi ke home + #about)
            }
        });
    });
    </script>


</body>