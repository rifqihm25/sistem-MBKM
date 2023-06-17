@extends('partials.app')
@section('page_styles')
    <link rel="stylesheet" href="{{ url('css/styleupload.css') }}">
@endsection
@section('content')
    <div class="container">
        <h2 class="header text-center mt-4">UPLOAD BERKAS</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($message = Session::get('warning'))
            <div class="alert alert-warning fade show" role="alert">
                {{ $message }}
            </div>
        @endif

        <form method="POST" action="{{ route('media.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="image">Gambar:</label>
                <input class="form-control" type="file" name="image" accept="image/*">
                @error('image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                @if (session('success'))
                    <span class="text-success">
                        {{ session('success') }}
                    </span>
                @endif

                @if ($message = Session::get('warning'))
                    <span class="text-warning" role="alert">
                        {{ $message }}
                    </span>
                @endif
            </div><br>
            <div class="form-group">
                <label for="pdf">File PDF:</label>
                <input class="form-control" type="file" class="form-control-file" name="pdf"
                    accept="application/pdf">
                @error('pdf')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                @if (session('success'))
                    <span class="text-success">
                        {{ session('success') }}
                    </span>
                @endif

                @if ($message = Session::get('warning'))
                    <span class="text-warning" role="alert">
                        {{ $message }}
                    </span>
                @endif
            </div><br>
            <button type="submit" class="btn-upload">Unggah</button>
        </form>

    </div>
@endsection
