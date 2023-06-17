@extends('partials.app')
@section('page_styles')
    <link rel="stylesheet" href="{{ url('css/styleberanda.css') }}">
@endsection
@section('content')
    <div class="banner">

        <div class="image">
            <img src="img/bg.png" alt="">
        </div>

        <div class="content">
            <h1>KAMPUS MERDEKA</h1>
            <p>Dapatkan kemerdekaan untuk membentuk masa depan yang sesuai dengan aspirasi kariermu.</p>
            <a href="{{ route('download.pdf1') }}"><button class="btn-info">Informasi</button></a>
            <a href="{{ route('download.pdf2') }}"><button class="btn-prgrm">Syarat & Ketentuan</button></a>
            <a href="{{ route('mahasiswa.index') }}"><button class="btn-dftr">Daftar Program</button></a>
            <a href="{{ route('upload-index') }}"><button class="btn-upload">Upload</button></a>
            <a href="{{ route('dosen.index') }}"><button class="btn-input">Input Dosen</button></a>
        </div>
    </div>
@endsection
