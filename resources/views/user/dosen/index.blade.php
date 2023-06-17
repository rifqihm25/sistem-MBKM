@extends('partials.app')
@section('page_styles')
    <link rel="stylesheet" href="{{ url('css/styledosen.css') }}">
@endsection
@section('content')
    <div class="container">
        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $message }}
            </div>
        @endif
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $message }}
            </div>
        @endif
        @foreach ($dsn as $dsn)
            <h2 class="header text-center mt-4">INPUT DOSEN</h2>
            <form method="POST" action="{{ route('dosen.store') }}">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama_dosen" class="form-control" id="nama_dosen"
                        placeholder="Masukan Nama Dosen" required>
                </div><br>

                <div class="form-group">
                    <label for="email">NIK</label>
                    <input type="number" name="nik" class="form-control" id="nik" placeholder="Masukan NIK Dosen"
                        required>
                </div><br>

                <div class="form-group">
                    <label for="email">Email</label>

                    <input type="email" name="email_dosen" class="form-control" id="email_dosen"
                        placeholder="Masukan Email Dosen" required>
                </div><br>

                <button type="submit" class="btn-simpan">Simpan</button>
            </form>
        @endforeach
    </div>
@endsection
