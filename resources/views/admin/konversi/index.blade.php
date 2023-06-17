@extends('layouts.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Konversi Mahasiswa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Konversi Mahasiswa</li>
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
                            <h3 class="card-title">Data Konversi Mahasiswa</h3>
                            <a href="{{ route('view-pdfkonversi') }}" class="btn btn-danger btn-end float-right"><i
                                    class="far fa-file-alt"></i>
                                Rekap Konversi</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>NPM</th>
                                        <th>Mata Kuliah</th>
                                        <th>SKS</th>
                                        <th>Nilai Mutu</th>
                                        <th>Tanggal Konversi</th>
                                    </tr>
                                </thead>
                                @php
                                    $no = 1;
                                @endphp
                                <tbody>
                                    @foreach ($konversi as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->npm }}</td>
                                            <td>
                                                @foreach ($item->konversi()->get() as $data)
                                                    <ol>

                                                        <i class="fa fa-circle"></i> {{ $data->matakuliah }}
                                                    </ol>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($item->konversi()->get() as $data)
                                                    <ol>

                                                        <i class="fa fa-circle"></i> {{ $data->sks }}
                                                    </ol>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($item->konversi()->get() as $data)
                                                    <ol>

                                                        <i class="fa fa-circle"></i> {{ $data->nilai_mutu }}
                                                    </ol>
                                                @endforeach
                                            </td>
                                            <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                        </tr>
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
