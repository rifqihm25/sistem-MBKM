@extends('layouts.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Akses Mahasiswa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Akses Mahasiswa</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Master Data Akses Mahasiswa</h3>
                            <button data-toggle="modal" data-target="#tambahModal"
                                class="btn btn-warning btn-end float-right"><i class="fa fa-plus" aria-hidden="true"></i>
                                Tambah User</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>NPM</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @php
                                    $no = 1;
                                @endphp
                                <tbody>
                                    @foreach ($user as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->email_mhs }}</td>
                                            <td>{{ $item->npm }}</td>
                                            <td>{{ $item->role }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary" data-toggle="modal"
                                                    data-target="#update-{{ $item->id }}" title="Edit"><i
                                                        class="far fa-edit"></i></button>
                                                <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                    data-target="#delete-{{ $item->id }}" title="Hapus"><i
                                                        class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <!-- Modal Delete -->
                                        <div class="modal fade" id="delete-{{ $item->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Hapus data ini?
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('user-page.destroy', $item->id) }}"
                                                        method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <div class="modal-body">
                                                            <span class="text-danger">
                                                                Data ini dihapus tidak bisa dipulihkan kembali!
                                                            </span>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-secondary"
                                                                data-dismiss="modal">Tutup</button>
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Tambah -->
                                        <div class="modal fade" id="update-{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="#exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <form action="{{ route('user-page.update', $item->id) }}" method="post"
                                                    class="form-horizontal">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit User</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group row">
                                                                <input type="text" id="user_id" name="user_id"
                                                                    value="{{ $item->user_id }}" hidden>
                                                                <label for="nama"
                                                                    class="col-lg-2 col-lg-offset-1 control-label">Nama:</label>
                                                                <div class="col-lg-12">
                                                                    <input type="text" name="nama" id="nama"
                                                                        class="form-control" required autofocus
                                                                        value={{ $item->nama }}>
                                                                    <span class="help-block with-errors"></span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="email_mhs"
                                                                    class="col-lg-2 col-lg-offset-1 control-label">Email:</label>
                                                                <div class="col-lg-12">
                                                                    <input type="email_mhs" name="email_mhs"
                                                                        id="email_mhs" class="form-control" required
                                                                        autofocus value={{ $item->email_mhs }}>
                                                                    <span class="help-block with-errors"></span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="npm"
                                                                    class="col-lg-2 col-lg-offset-1 control-label">NPM:</label>
                                                                <div class="col-lg-12">
                                                                    <input type="number" name="npm" id="npm"
                                                                        class="form-control" required autofocus
                                                                        value={{ $item->npm }}>
                                                                    <span class="help-block with-errors"></span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="role"
                                                                    class="col-lg-2 col-lg-offset-1 control-label">Role:</label>
                                                                <div class="col-lg-12">
                                                                    <input type="text" name="role" id="role"
                                                                        class="form-control" readonly autofocus
                                                                        value="user">
                                                                    <span class="help-block with-errors"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-primary"><i class="fa fa-save"></i>
                                                                Simpan</button>
                                                            <button type="button" class="btn btn-warning"
                                                                data-dismiss="modal"><i
                                                                    class="fa fa-arrow-circle-left"></i> Batal</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                    <!-- End Modal -->
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->

        <!-- Modal Tambah -->
        <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="#exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form action="{{ route('user-page.store') }}" method="post" class="form-horizontal">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah User</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="nama" class="col-lg-2 col-lg-offset-1 control-label">Nama:</label>
                                <div class="col-lg-12">
                                    <input type="text" name="nama" id="nama" class="form-control" required
                                        autofocus>
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email_mhs" class="col-lg-2 col-lg-offset-1 control-label">Email:</label>
                                <div class="col-lg-12">
                                    <input type="email_mhs" name="email_mhs" id="email_mhs" class="form-control"
                                        required autofocus>
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="npm" class="col-lg-2 col-lg-offset-1 control-label">NPM:</label>
                                <div class="col-lg-12">
                                    <input type="number" name="npm" id="npm" class="form-control" required
                                        autofocus>
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="role" class="col-lg-2 col-lg-offset-1 control-label">Role:</label>
                                <div class="col-lg-12">
                                    <input type="text" name="role" id="role" class="form-control" readonly
                                        autofocus value="user">
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal"><i
                                    class="fa fa-arrow-circle-left"></i> Batal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endsection
    @section('page_script')
        <script>
            $(function() {
                $("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                });
            });
        </script>
    @endsection
