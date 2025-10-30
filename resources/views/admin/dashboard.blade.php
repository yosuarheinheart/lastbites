<head>
        <title>Admin Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
        <link href="{{ asset('css/style_admin_dashboard.css') }}" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Admin Dashboard</h2>
        <p class="text-center text-muted">Review and confirm SIUP documents uploaded by sellers.</p>

        @if ($users->isNotEmpty())
            @foreach ($users as $user)
            <div class="card mb-3">
                <div class="card-header">
                    Seller: {{ $user->first_name }} {{ $user->last_name }}
                </div>
                
                <div class="card-body">
                    <p class="card-text">SIUP Document:</p>
                    <button class="btn btn-show btn-sm" onclick="toggleSIUP({{ $user->user_id }})">Show SIUP Document</button>
                    <iframe id="siup-{{ $user->user_id }}" src="{{ asset($user->siup) }}" frameborder="0" style="display:none; width: 100%; height: 400px;"></iframe>

                    <form action="{{ route('admin.dashboard.action') }}" method="POST" class="mt-3" id="form-{{ $user->user_id }}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->user_id }}">
                        <button type="submit" name="action" value="approve" class="btn btn-success btn-sm" onclick="removeRequired({{ $user->user_id }})">Approve</button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="showRejectionForm({{ $user->user_id }})">Reject</button>

                        <div id="rejection-form-{{ $user->user_id }}" style="display: none; margin-top: 10px;">
                            <textarea name="rejection_note" class="form-control rejection-note" placeholder="Enter rejection note (required)"></textarea>
                            <button type="submit" name="action" value="reject" class="btn btn-danger btn-sm">Submit Rejection</button>
                        </div>
                    </form>
                    
                    <script>
                        function toggleSIUP(userId) {
                            $('#siup-' + userId).toggle();
                        }

                        function showRejectionForm(userId) {
                            $('#rejection-form-' + userId).show();
                            $('#form-' + userId).find('.rejection-note').attr('required', true);
                        }

                        function removeRequired(userId) {
                            $('#form-' + userId).find('.rejection-note').removeAttr('required');
                        }
                    </script>
                </div>
            @endforeach
        @else
            <p class="text-center">No pending SIUP documents to review.</p>
        @endif
                </div>
            </div>
    </div>

    @include('layouts.footer')
</body>