@extends('layouts.master')
@section('meta_header')
    <link rel="stylesheet" href="{{ url('assets/css/style-input-file.css') }}" />
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Data Berkas Mahasiswa</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('master-mahasiswa.update', ['master_mahasiswa' => $mhs->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                            <div class="row">
                                <div class="col-12">
                                    <div class="post">
                                        <div class="user-block">
                                            @if ($mhs->image === null)
                                                <img class="img-box img-bordered-sm" id="img-preview"
                                                    src="{{ url('assets/img/user1-128x128.jpg') }}" alt="user image">
                                            @else
                                                <img class="img-box img-bordered-sm" id="img-preview"
                                                    src="{{ asset('/storage/' . $mhs->image) }}" alt="user image">
                                            @endif
                                            <span class="username text-primary">
                                                {{ $mhs->nama }}
                                            </span>
                                            <span class="description">{{ $mhs->email_mhs }}</span>
                                            <button type="button" class="btn btn-sm btn-primary view-button mt-1"
                                                id="view-button">View</button>
                                            <label for="image" class="custom-file-upload">Upload</label>
                                            <input class="form-control image-profile" type="file" id="image"
                                                name="image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                            <h5 class="mt-5 text-muted">Berkas</h5>
                            <ul class="list-unstyled">
                                @if ($mhs->pdf === null)
                                    <li>
                                        <p><a class="btn-link text-secondary"><i
                                                    class="far fa-fw
                                                fa-file-pdf"></i>
                                                No File</a></p>
                                    </li>
                                @else
                                    <li>
                                        <p><a class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i>
                                                {{ $mhs->pdf }}</a></p>
                                    </li>
                                @endif
                            </ul>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="pdf">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-left"><i class="fa fa-save"></i>
                        Simpan</button>
                </form>
            </div>
        </div>

        <!-- Modal View -->
        <div class="modal fade" id="view-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="user-user">
                            @if ($mhs->image === null)
                                <img class="img-box img-bordered-sm img-view"
                                    src="{{ url('assets/img/user1-128x128.jpg') }}" alt="user image">
                            @else
                                <img class="img-box img-bordered-sm img-view" src="{{ asset('/storage/' . $mhs->image) }}"
                                    alt="user image">
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
@section('page_script')
    <script>
        $(document).on('click', '#view-button', async function(event) {
            $('#view-modal').modal('show');
        });

        $(document).ready(function(e) {
            $('#image').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#img-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });

        $(function() {
            bsCustomFileInput.init();
        });
    </script>
@endsection
