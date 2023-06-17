@if ($message = Session::get('error'))
    <span class="text-danger" role="alert">
        {{ $message }}
    </span>
@endif
@if ($message = Session::get('success'))
    <span class="text-danger" role="alert">
        {{ $message }}
    </span>
@endif
