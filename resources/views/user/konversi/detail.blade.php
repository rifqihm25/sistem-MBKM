@extends('partials.app')
@section('meta_header')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css" />
@endsection
@section('content')
    <div class="container">
        <h2 class="header text-center mt-4">DETAIL KONVERSI</h2>

        <div class="card">
            <div class="form-row m-2">
                <a href="{{ route('export-konversi') }}" class="btn btn-secondary float-right">Unduh Berkas</a>
                <div class="form-group">
                    <div class="form-group">
                        <br>
                        <label for="nama">Nama Mahasiswa</label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama"
                            value="{{ $mhs->nama }}" readonly>
                    </div><br>
                    <div class="form-group">
                        <label for="npm">NPM</label>
                        <input type="number" name="npm" class="form-control" id="npm" value="{{ $mhs->npm }}"
                            placeholder="NPM" readonly>
                    </div><br>
                    <div class="form-group">
                        <label for="no_telepon">Nomor Telepon</label>
                        <input type="number" name="no_telepon" class="form-control" id="no_telepon"
                            value="{{ $mhs->no_telepon }}" placeholder="Nomor Telepon" readonly>
                    </div><br>
                    <div class="form-group">
                        <label for="fakultas">Fakultas</label>
                        <input type="text" name="fakultas" class="form-control" id="fakultas"
                            value="{{ $mhs->fakultas }}" placeholder="Fakultas" readonly>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="jurusan">Program Studi</label>
                        <input type="text" name="jurusan" class="form-control" id="jurusan" value="{{ $mhs->jurusan }}"
                            placeholder="Program Studi" readonly>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <input type="number" name="semester" class="form-control" id="semester"
                            value="{{ $mhs->semester }}" placeholder="Semester" readonly>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="jenis_mbkm">Nama Program MBKM</label>
                        <input type="text" name="jenis_mbkm" class="form-control" id="jenis_mbkm"
                            value="{{ $mhs->nama_mbkm }}" placeholder="Nama Program MBKM" readonly>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="created_at">Tanggal Konversi</label>
                        <input type="text" name="created_at" class="form-control" id="created_at"
                            value="{{ $mhs->created_at->format('d-m-Y') }}" readonly>
                    </div>
                </div>
            </div>
        </div>
        <br>

        <div class="card">
            <div class="card-body">
                <div class="table">
                    <table id="example" class="table table-striped table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Mata Kuliah</th>
                                <th>SKS</th>
                                <th>Nilai Mutu</th>
                            </tr>
                        </thead>
                        @php
                            $no = 1;
                        @endphp
                        <tbody>
                            @foreach ($konversi as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->matakuliah }}</td>
                                    <td>{{ $item->sks }}</td>
                                    <td>{{ $item->nilai_mutu }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br>
    </div>
@endsection
@section('page_js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
@endsection
@section('page_script')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
