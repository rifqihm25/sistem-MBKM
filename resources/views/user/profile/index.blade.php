@extends('partials.app')
@section('page_styles')
    <link rel="stylesheet" href="{{ url('css/stylekonversi.css') }}">
@endsection
@section('meta_header')
    <style>
        .card {
            align-items: center;
            margin: auto;
            margin-top: 40px;
            padding-right: 0;
            height: 365px;
            width: 125vh;
        }

        .card-content {
            margin-left: 40%;
            margin-right: 0;
            display: block;
        }

        .user-block {
            float: left;
        }

        .user-block img {
            height: 300px;
            width: 250px;
            margin-top: 30px;
            margin-left: 25px;
        }

        /* .user-block.user-block-sm img {
                    width: 1.875rem;
                    height: 1.875rem;
                } */
        /*button upload image employee profile */
        .image-profile {
            display: none;
        }

        .custom-file-upload {
            border: none;
            border-radius: 6px;
            background-color: #726f97;
            padding: 5px 70px;
            color: white;
            cursor: pointer;
            float: left;
            width: 200px;
            height: 35px;
            margin-top: 0;
            margin-left: 0;
            font-weight: lighter;
        }

        .custom-file-upload:hover {
            background: red;
        }

        .btn-simpan {
            border: none;
            border-radius: 6px;
            background-color: #e0ac1c;
            color: white;
            width: 200px;
            height: 35px;
            margin-left: 2%;
        }

        .btn-simpan:hover {
            background: red;
        }

        .tombol {
            margin-top: 0;
            margin-bottom: 0;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <h2 class="header text-center mt-4">PROFIL</h2>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="row">
            <form action="{{ route('updateProfile', $mhs->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="card col form-group row">
                    <!-- <div class="card col-lg-2 form-group row"> -->
                    <div class="card-img">
                        <div class="user-block">
                            @if ($mhs->foto_profil === null)
                                <img class="img-box img-bordered-sm" id="img-preview"
                                    src="{{ url('assets/img/no-profile.jpg') }}" alt="user image">
                            @else
                                <img class="img-box img-bordered-sm" id="img-preview"
                                    src="{{ asset('/storage/' . $mhs->foto_profil) }}" alt="user image">
                            @endif
                        </div><br>

                        <div class="card-content">
                            <div class="form-group col-md-11">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" value="{{ $mhs->nama }}" class="form-control">
                            </div><br>
                            <div class="form-group col-md-11">
                                <label for="npm">NPM</label>
                                <input type="text" name="npm" value="{{ $mhs->npm }}" class="form-control">
                            </div><br>
                            <div class="form-group col-md-11">
                                <label for="email_mhs">Email</label>
                                <input type="text" name="email_mhs" value="{{ $mhs->email_mhs }}" class="form-control">
                            </div><br>
                            <div class="tombol">
                                <label for="image" class="custom-file-upload">Upload</label>
                                <input class="form-control image-profile" type="file" id="image" name="image">
                                <button type="submit" class="btn-simpan">Simpan</button>
                            </div><br>
                        </div>
                    </div>
                    <!-- </div> -->
                    <!-- </div>
                        <br>
                        <div > -->
                    {{-- <div class="card-content">
                        <div class="form-group col-md-8">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" value="{{ $mhs->nama }}" class="form-control">
                        </div><br>
                        <div class="form-group col-md-8">
                            <label for="npm">NPM</label>
                            <input type="text" name="npm" value="{{ $mhs->npm }}" class="form-control">
                        </div><br>
                        <div class="form-group col-md-8">
                            <label for="email_mhs">Email</label>
                            <input type="text" name="email_mhs" value="{{ $mhs->email_mhs }}" class="form-control">
                        </div><br>
                    </div> --}}
                    {{-- </div><br> --}}
                    {{-- <div class="tombol">
                    <label for="image" class="custom-file-upload">Upload</label>
                    <input class="form-control image-profile" type="file" id="image" name="image">
                    <button type="submit" class="btn-simpan">Simpan</button>
                </div> --}}
                </div>
        </div>
    @endsection
    @section('page_js')
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    @endsection
    @section('page_script')
        <script>
            $(document).ready(function(e) {
                $('#image').change(function() {
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        $('#img-preview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                });
            });
        </script>
    @endsection
