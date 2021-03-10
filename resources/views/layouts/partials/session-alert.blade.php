@if (session('status'))
    <div class="alert alert-{{ $type }}" role="alert">
        {{ session('status') }}
    </div>
@endif