<head>
    <title>LastBites - Discover Quality Food & Reduce Waste</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link href="{{ asset('css/style_home.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    @section('title', 'Lastbites Homepage')
    @section ('description', 'Join LastBites to discover quality food, enjoy discounts, and help reduce food waste. Supporting sustainability starts here')
    @section('keywords', 'food waste reduction', 'quality food', 'discounted meals', 'food surplus')

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>

<body>
    @include('layouts.nav')

    <button id="backToTop" class="btn btn-primary">
        <i class="bi bi-caret-up-fill"></i>
    </button>

    <div class="container mt-4">
        <div data-aos="zoom-out" data-aos-duration="750" class="text-center mb-4">
            <h1>Welcome, {{ $user->first_name }}!</h1>
            <p>Find your next meal and enjoy discounted prices on quality food!</p>
        </div>

        <form data-aos="zoom-in" data-aos-duration="1000" action="{{ route('search') }}" method="GET" class="mb-4">
            <div class="input-group mb-2">
                <input type="text" name="search" class="form-control" placeholder="Search for products or stores" required>
                <div class="input-group-append">
                    <button class="btn btn-search" type="submit">Search</button>
                </div>
            </div>
        </form>

        
        @if($userStores->isNotEmpty())
            <div class="container mt-4">
                <h2 class="mb-4">Visit Again!</h2>
                    <div class="row">
                        @foreach($userStores as $store)
                            <div class="col-6 col-md-3 mb-4 text-center">
                                <div data-aos="zoom-in" data-aos-duration="500" class="store-card">
                                    <a href="{{ route('store.view', ['store_id' => $store->store_id]) }}">
                                        <img src="{{ asset($store->store_picture) }}" class="img-fluid store-card-img" alt="Store: {{ $store->store_name }}">
                                        <p class="mt-2">{{ $store->store_name }}</p>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
            </div>
        @endif

        <div class="container mt-4">
            <h2 class="mb-4">Categories</h2>
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-6 col-md-3 mb-4 text-center">
                        <div data-aos="zoom-in" data-aos-duration="300" class="category-card">
                            <a href="{{ route('category.view', ['category_id' => $category->category_id]) }}">
                                <img src="{{ asset($category->category_picture) }}" class="img-fluid category-card-img" alt="{{ $category->category_name }} Category">
                                <p class="mt-2">{{ $category->category_name }}</p>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="container mt-4">
        <h2 class="mb-4">Stores other people like...</h2>
        <div class="row">
            @foreach ($popularStores as $store)
                <div class="col-6 col-md-3 mb-4 text-center">
                    <div data-aos="zoom-in" data-aos-duration="500" data-aos-delay="500" class="store-card">
                        <a href="{{ route('store.view', ['store_id' => $store->store_id]) }}">
                            <img src="{{ asset($store->store_picture) }}" class="img-fluid store-card-img" alt="{{ $store->store_name }}">
                            <p class="mt-2">{{ $store->store_name }}</p>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <section id="about">
        <div class="container about-section mt-5">
            <div class="row align-items-center">
                <div data-aos="fade-right" data-aos-duration="750" class="col-md-6 d-flex justify-content-center align-items-center">
                    <img src="{{ asset('asset/aboutus.png') }}" alt="About LastBites Platform Illustration" class="img-fluid transparent-img">
                </div>

                <div data-aos="fade-left" data-aos-duration="750" class="col-md-6">
                    <h2 class="mb-4">About Us</h2>
                    <p>
                        At <strong>LastBites</strong>, we’re passionate about connecting people with amazing food while making a difference.
                        Our platform helps reduce food waste by offering discounted, high-quality meals from local food businesses.
                    </p>
                    <p>
                        By joining us, you’re not only enjoying delicious meals but also supporting sustainability and helping businesses manage surplus food efficiently.
                    </p>
                    <a  href="{{ route('learnmore.view') }}"data-aos="zoom-in" data-aos-duration="750" data-aos-delay="500" href="home" class="btn btn-learn mt-3">Learn More</a>
                </div>
            </div>
        </div>

        <div class="container waste-section mt-5">
            <div class="row align-items-center">
                <div data-aos="fade-right" data-aos-duration="750" data-aos-delay="500" class="col-md-6 text-center">
                    <h2 class="waste-title mb-4">23 – 48 juta ton makanan terbuang sia-sia per tahunnya di Indonesia</h2>
                    <p class="waste-description">
                        Kontribusi besar terbuangnya makanan berasal dari hotel, restoran, katering, supermarket,
                        dan masyarakat yang gemar menyisakan makanannya.
                        <br><br>
                        Kerugian ekonomi akibat makanan terbuang:
                    </p>
                    <h3 class="waste-cost"><strong>Rp <span id="waste-amount">213</span> – 551 triliun/tahun</strong></h3>
                    <small class="source">Kajian BAPPENAS (2021)</small>
                </div>

                <div data-aos="fade-left" data-aos-duration="750" data-aos-delay="500" class="col-md-6 text-center">
                    <img src="{{ asset('asset/food-waste.png') }}" alt="Illustration of Food Waste Statistics" class="img-fluid waste-img">
                    <div data-aos="fade-up" data-aos-duration="750" class="global-waste mt-3">
                        <h5><span id="global-waste">1,157,316,875</span> Tonnes of food lost or wasted</h5>
                        <small>Globally this year</small>
                    </div>
                </div>
            </div>
        </div>
        </section>
        <script>
            const backToTopButton = document.getElementById("backToTop");

            window.onscroll = function() {
                if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                    backToTopButton.style.display = "block";
                } else {
                    backToTopButton.style.display = "none";
                }
            };

            backToTopButton.addEventListener("click", function() {
                window.scrollTo({
                    top: 0,
                    behavior: "smooth"
                });
            });
        </script>

        <script>
            AOS.init({
                once: true,
            });
        </script>
    </div>
        </div>
    @include('layouts.footer')
</body>