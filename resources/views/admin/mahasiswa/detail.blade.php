@extends('layouts.master')
@section('meta_header')
    <style>
        .user-user {
            /* float: left; */
            justify-content: space-evenly;
        }

        .user-user .img-view {
            /* float: left; */
            justify-content: center;
            height: 700px;
            width: 460px;
        }

        .user-user.user-user-sm .img-view {
            width: 1.875rem;
            height: 1.875rem;
        }
    </style>
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Data Berkas Mahasiswa</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                        <div class="row">
                            <div class="col-12">
                                <div class="post">
                                    <div class="user-block">
                                        @if ($mhs->image === null)
                                            <img class="img-box img-bordered-sm"
                                                src="{{ url('assets/img/user1-128x128.jpg') }}" alt="user image">
                                        @else
                                            <img class="img-box img-bordered-sm"
                                                src="{{ asset('/storage/' . $mhs->image) }}" alt="user image">
                                        @endif
                                        <span class="username text-primary">
                                            {{ $mhs->nama }}
                                        </span>
                                        <span class="description">{{ $mhs->email_mhs }}</span>
                                        <button class="btn btn-sm btn-primary view-button mt-1"
                                            id="view-button">View</button>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        @if ($mhs->status === $lengkap)
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ $mhs->status }}
                                            </div>
                                        @elseif ($mhs->status === $blmlengkap)
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                {{ $mhs->status }}
                                            </div>
                                        @endif
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
                                    <p><a class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i>
                                            No File</a></p>
                                </li>
                            @else
                                <li>
                                    <p><a href="{{ route('pdf.download', $mhs->mahasiswa_id) }}"
                                            class="btn-link text-secondary" target="_blank"><i
                                                class="far fa-fw fa-file-pdf"></i>
                                            {{ $mhs->pdf }}</a></p>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
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
    </script>
@endsection
