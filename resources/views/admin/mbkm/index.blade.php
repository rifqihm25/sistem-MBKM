@extends('layouts.master')
@section('page_styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Rekap MBKM</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Rekap MBKM</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Rekap MBKM</h3>
                            <!-- BEGIN CUSTOM FILTER -->
                            <form action="{{ route('mbkm.index') }}" method="post" class="float-lg-right">
                                @method('get')
                                @csrf
                                <div class="form-group">
                                    <div class="form-group">
                                        <input type="text" name="date" aria-controls="datatables-ajax"
                                            id="select-date" value="{{ request('date') }}" class="form-control"
                                            placeholder="Pilih Tanggal" />
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-md float-right">Filter</button>
                            </form>
                            <!-- END CUSTOM FILTER -->
                            <a href="{{ route('view-pdfmbkm') }}" class="btn btn-danger btn-end float-right mr-3"><i
                                    class="far fa-file-alt"></i>
                                Rekap MBKM</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis MBKM</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                @php
                                    $no = 1;
                                @endphp
                                <tbody>
                                    @if ($let === null)
                                        @foreach ($data as $data)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $data['nama_mbkm'] }}</td>
                                                <td>{{ $data['jumlah'] }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        @foreach ($mbkms as $item)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $item->nama_mbkm }}</td>
                                                <td>{{ $item->mahasiswas_count }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
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
@section('page_js')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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

        $('#select-date').flatpickr({
            altInput: true,
            dateFormat: "Y-m-d",
            allowInput: true,
            altInput: true,
            altFormat: "Y-m-d",
        });
    </script>
@endsection
