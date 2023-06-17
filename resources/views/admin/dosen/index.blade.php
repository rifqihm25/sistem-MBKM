@extends('layouts.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Dosen Penguji Mahasiswa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Dosen Penguji Mahasiswa</li>
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
                            <h3 class="card-title">Data Dosen Penguji Mahasiswa</h3>
                            <a href="{{ route('view-pdfdosen') }}" class="btn btn-danger btn-end float-right"><i
                                    class="far fa-file-alt"></i>
                                Rekap Data Dosen Penguji</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>NPM</th>
                                        <th>Nama Dosen Penguji</th>
                                        <th>NIK Dosen Penguji</th>
                                        <th>Email Dosen Penguji</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @php
                                    $no = 1;
                                @endphp
                                <tbody>
                                    @foreach ($dsn as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->npm }}</td>
                                            <td>{{ $item->nama_dosen }}</td>
                                            <td>{{ $item->nik }}</td>
                                            <td>{{ $item->email_dosen }}</td>
                                            <td class="text-center m-1">
                                                <button class="btn btn-sm btn-primary" data-toggle="modal"
                                                    data-target="#update-{{ $item->id }}" title="Edit"><i
                                                        class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                    data-target="#delete-{{ $item->id }}" title="Hapus"><i
                                                        class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <!-- Modal -->
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
                                                    <form action="{{ route('master-mhs-dsn.destroy', $item->id) }}"
                                                        method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <div class="modal-body">
                                                            <span class="text-danger">
                                                                Data ini akan dihapus!
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

                                        <div class="modal fade" id="update-{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="#exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <form action="{{ route('master-mhs-dsn.update', $item->id) }}"
                                                    method="post" class="form-horizontal">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group row">
                                                                <label for="nam_dosen"
                                                                    class="col-lg-2 col-lg-offset-1 control-label">Nama
                                                                    Dosen:</label>
                                                                <div class="col-lg-12">
                                                                    <input type="text" name="nama_dosen" id="nama_dosen"
                                                                        class="form-control" required autofocus
                                                                        value={{ $item->nama_dosen }}>
                                                                    <span class="help-block with-errors"></span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="nik"
                                                                    class="col-lg-2 col-lg-offset-1 control-label">NIK:</label>
                                                                <div class="col-lg-12">
                                                                    <input type="number" name="nik" id="nik"
                                                                        class="form-control" required autofocus
                                                                        value={{ $item->nik }}>
                                                                    <span class="help-block with-errors"></span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="email_dosen"
                                                                    class="col-lg-2 col-lg-offset-1 control-label">Email:</label>
                                                                <div class="col-lg-12">
                                                                    <input type="text" name="email_dosen"
                                                                        id="email_dosen" class="form-control" required
                                                                        autofocus value={{ $item->email_dosen }}>
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
    </section>
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
