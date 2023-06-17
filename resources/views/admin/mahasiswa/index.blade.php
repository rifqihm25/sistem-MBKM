@extends('layouts.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Berkas Mahasiswa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Berkas Mahasiswa</li>
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
                            <h3 class="card-title">Master Data Mahasiswa</h3>
                            <a href="{{ route('view-pdf') }}" class="btn btn-danger btn-end float-right"><i
                                    class="far fa-file-alt"></i>
                                Rekap Berkas Mahasiswa</a>
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
                                        <th>Fakultas</th>
                                        <th>Jurusan</th>
                                        <th>Semester</th>
                                        <th>IPK</th>
                                        <th>Jenis MBKM</th>
                                        <th>Periode</th>
                                        <th>Tanggal Daftar</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @php
                                    $no = 1;
                                @endphp
                                <tbody>
                                    @foreach ($mhs as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->email_mhs }}</td>
                                            <td>{{ $item->npm }}</td>
                                            <td>{{ $item->fakultas }}</td>
                                            <td>{{ $item->jurusan }}</td>
                                            <td>{{ $item->semester }}</td>
                                            <td>{{ $item->ipk }}</td>
                                            <td>{{ $item->nama_mbkm }}</td>
                                            <td>Semester {{ $item->periode_smt }}</td>
                                            <td>{{ $item->tgl_daftar }}</td>
                                            @if ($item->status === $lengkap)
                                                <td><span
                                                        class="badge badge-success badge-rounded badge-sm">{{ $item->status }}</span>
                                                </td>
                                            @elseif ($item->status === $blmlengkap)
                                                <td><span
                                                        class="badge badge-rounded badge-danger badge-sm">{{ $item->status }}</span>
                                                </td>
                                            @elseif ($item->status === null)
                                                <td><span
                                                        class="badge badge-rounded badge-danger badge-sm">{{ $blmlengkap }}</span>
                                                </td>
                                            @endif
                                            <td class="text-center m-1">
                                                <a href="{{ route('master-mahasiswa.show', $item->id) }}"
                                                    class="btn btn-sm btn-primary"><i class="fas fa-eye"
                                                        title="Detail"></i></a>
                                                <a href="{{ route('master-mahasiswa.edit', $item->id) }}"
                                                    class="btn btn-sm btn-primary"><i class="far fa-edit"></i></a>
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
                                                    <form action="{{ route('master-mahasiswa.destroy', $item->id) }}"
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
