<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>LastBites Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="{{ asset('css/style_guest.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style_nav.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css">
    <meta name="description" content="@yield('description', 'Join LastBites to discover quality food, enjoy discounts, and help reduce food waste. Supporting sustainability starts here')">
    <meta name="keywords home" content="@yield('keywords', 'food waste reduction', 'quality food', 'discounted meals', 'food surplus', 'lastbites')">
    @section('title', 'Lastbites Homepage')
    @section ('description', 'Join LastBites to discover quality food, enjoy discounts, and help reduce food waste. Supporting sustainability starts here')
    @section('keywords', 'food waste reduction', 'quality food', 'discounted meals', 'food surplus', 'lastbites')
    <style>
        .splash-screen {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to bottom, #006b5e, #63baab);
            overflow: hidden;
            animation: fadeIn 1.5s ease-out;
        }

        .splash-logo {
            animation: bounce 3s;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-20px);
            }
            60% {
                transform: translateY(-10px);
            }
        }

        .hidden {
            animation: fadeOut 1s ease-out;
        }

        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; }
        }
    </style>
</head>
<body>
    <div id="splash-screen" class="splash-screen">
        <div class="text-center" style="color:white;">
            <img src="{{ asset('asset/logo.png') }}" alt="Logo" class="splash-logo mb-3" style="width: 150px;">
        </div>
    </div>

    <div id="main-content" style="display: none;">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('asset/logo.png') }}" alt="Logo" width="50" height="50" class="d-inline-block align-top mr-2">
                LastBites
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="btn btn-rl" href="{{ route('login.view') }}">Register/Login</a>
                    </li>
                </ul>
            </div>
        </nav>

        <section class="position-relative">
            <video src="{{ asset('asset/profile.mp4') }}" autoplay loop muted></video>
            <div class="overlay">
                <h1 class="display-1">WELCOME</h1>
                <h5 class="display-5">LastBites</h5>
                <p>Waste Less, Feed More</p>
            </div>
        </section>

        <section class="p-5 bg-light">
            <div class="container" data-aos="fade-down" data-aos-duration="750">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h2>LastBites Info</h2>
                        <p>At LastBites, we’re passionate about reducing food waste and offering discounted, high-quality meals from local food businesses. By joining us, you’re supporting sustainability and businesses managing surplus food efficiently.</p>
                    </div>
                    <div class="col-md-6 text-center">
                        <img src="{{ asset('asset/aboutus.png') }}" class="img-fluid" alt="About Us">
                    </div>
                </div>
            </div>
        </section>

        @include('layouts.footer')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            setTimeout(() => {
                const splashScreen = document.getElementById("splash-screen");
                const mainContent = document.getElementById("main-content");

                splashScreen.classList.add("hidden");
                setTimeout(() => {
                    splashScreen.style.display = "none";
                    mainContent.style.display = "block";
                }, 1000); 
            }, 2500); 
        });
    </script>

    <script>
        AOS.init({
            once: true,
        });
    </script>
</body>
