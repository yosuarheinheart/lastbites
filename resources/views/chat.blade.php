<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link href="{{ asset('css/style_chat.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>
    @include('layouts.nav')

    <div class="chat-container">
        <div class="chat-header">
            <a href="{{ url()->previous() }}" class="back-button">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 18L9 12L15 6" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
            <img src="{{ asset($recipient->profile_picture) }}" alt="Profile Picture" class="profile-picture">
            <h2>{{ $recipient->first_name }} {{ $recipient->last_name }}</h2>
        </div>

        <div class="chat-box">
            @if ($messages->isNotEmpty())
                @php $previousDate = null; @endphp
                @foreach ($messages as $msg)
                    @php
                        $currentDate = \Carbon\Carbon::parse($msg->sent_at)->format('Y-m-d');
                    @endphp

                    @if ($currentDate !== $previousDate)
                        <div class="date-divider">{{ \Carbon\Carbon::parse($msg->sent_at)->format('j F Y') }}</div>
                        @php $previousDate = $currentDate; @endphp
                    @endif

                    <div class="chat-message {{ $msg->sender_id === $user_id ? 'sent' : 'received' }}">
                        @if ($msg->sender_id !== $user_id)
                            <img src="{{ asset($msg->profile_picture) }}" alt="Profile Picture" class="chat-profile-picture left">
                        @endif
                        <div class="message-content">
                            <p class="mt-1">{{ $msg->message }}</p>
                            <span class="timestamp">{{ \Carbon\Carbon::parse($msg->sent_at)->format('H:i') }}</span>
                        </div>
                        @if ($msg->sender_id === $user_id)
                            <img src="{{ asset($msg->profile_picture) }}" alt="Profile Picture" class="chat-profile-picture right">
                        @endif
                    </div>
                @endforeach
            @else
                <p class="no-messages">No messages yet. Start the conversation!</p>
            @endif
        </div>

        <form action="{{ route('chat.send', ['receiver_id' => $receiver_id]) }}" method="POST" class="chat-form mb-4" style="margin-bottom: 20px;">
            @csrf
            <input type="text" name="message" placeholder="Type your message..." required>
            <button type="submit">Send</button>
        </form>

    @include('layouts.footer')
</body>