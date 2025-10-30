<head>
    <title>Chat History</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFX0dJZ4" crossorigin="anonymous">
    <link href="{{ asset('css/style_chat_history.css') }}" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

</head>

<body>
    @include('layouts.nav')

    <div class="container cart-history mt-4">
        <h1 data-aos="fade-down" data-aos-duration="1000">Chat History</h1>
        @if (!empty($chatPartners))
            <div class="list-group">
                @foreach ($chatPartners as $partner)
                    <a data-aos="zoom-in" data-aos-duration="1000" 
                    href="{{ route('chat.view', ['receiver_id' => $partner->user_id]) }}" class="list-group-item list-group-item-action d-flex align-items-center">
                        <img data-aos="fade-right" data-aos-duration="1000"
                        src="{{ asset($partner->profile_picture ?? 'default-profile.png') }}" alt="Profile Picture" class="chat-profile-picture mr-3">
                        <div data-aos="zoom-out" data-aos-duration="1000" class="d-flex justify-content-between w-100">
                            <div>
                                <strong>{{ htmlspecialchars($partner->first_name . ' ' . $partner->last_name) }}</strong>
                                <p class="mb-0 text-detail">{{ htmlspecialchars($partner->latest_message) }}</p>
                            </div>
                            <small class="text-detail">
                                {{ \Carbon\Carbon::parse($partner->latest_message_time)->format('H:i') }}
                            </small>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <p>No chats available. Start a conversation with someone!</p>
        @endif
    </div>

    @include('layouts.footer')
</body>

<script>
    AOS.init({
    once: true,
    });
</script>