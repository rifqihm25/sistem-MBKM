@extends('partials.app')
@section('page_styles')
    <link rel="stylesheet" href="{{ url('css/stylekonversi.css') }}">
@endsection
@section('content')
    <div class="container">
        <h2 class="header text-center mt-4">KONVERSI</h2>

        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $message }}
            </div>
        @endif
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $message }}
            </div>
        @endif

        <div class="card">
            <div class="form-row m-2">
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
                        <label for="no_telepon">Nomor Telepon</label>
                        <input type="number" name="no_telepon" class="form-control" id="no_telepon"
                            value="{{ $mhs->no_telepon }}" placeholder="Nomor Telepon" readonly>
                    </div>
                </div>
            </div>
        </div>
        <br>

        <div class="card">

            <form method="POST" action="{{ route('konversi.store') }}" class="m-2">
                @csrf
                <div class="form-row" id="dynamic_form">
                    <div class="form-group baru-data">
                        <div class="form-group">
                            <br>
                            <label for="matakuliah">Nama Matakuliah</label>
                            <input type="text" name="matakuliah[]"
                                class="form-control @error('matakuliah') is-invalid @enderror" id="matakuliah"
                                placeholder="Nama Matakuliah" value="{{ old('matakuliah') }}" required>
                            @error('matakuliah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div><br>
                        <div class="form-group">
                            <label for="sks">SKS</label>
                            <input type="number" name="sks[]"
                                class="form-control @error('sks')
                            is-invalid
                        @enderror"
                                id="sks" value="{{ old('sks') }}" placeholder="Jumlah SKS" required>
                            @error('sks')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div><br>
                        <div class="form-group">
                            <label for="nilai_mutu">Nilai Mutu</label>
                            <select class="form-control @error('nilai_mutu') is-invalid
                        @enderror"
                                name="nilai_mutu[]" id="nilai_mutu" required value="{{ old('nilai_mutu') }}">
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                            </select>
                            @error('nilai_mutu')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>
                        <div class="button-group">
                            <button type="button" class="btn-tambah">Tambah Matakuliah</button>
                            <button type="button" class="btn-hapus" style="display:none;">Hapus Matakuliah</button>
                        </div>
                    </div>
                </div>
                <br><br>
                <button type="submit" class="btn-konversi">Simpan</button>
            </form>
        </div>

    </div>
@endsection
@section('page_js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endsection
@section('page_script')
    <script>
        function addForm() {
            let addrow =
                '<div class="form-group baru-data">\
                                <div class="form-group">\
                <br>\
                <label for="matakuliah">Nama Matakuliah</label>\
                <input type="text" name="matakuliah[]" class="form-control" id="matakuliah" placeholder="Nama Matakuliah" required>\
            </div>\
            <br>\
            <div class="form-group">\
                <label for="sks">SKS</label>\
                <input type="angka" name="sks[]" class="form-control" id="sks"placeholder="Jumlah SKS" required>\
            </div>\
            <br>\
            <div class="form-group">\
                <label for="nilai_mutu">Nilai Mutu</label>\
                <select class="form-control" name="nilai_mutu[]" id="nilai_mutu" required>\
                    <option value="A">A</option>\
                    <option value="B">B</option>\
                    <option value="C">C</option>\
                    <option value="D">D</option>\
                    <option value="E">E</option>\
                </select>\
            </div>\
            <br>\
            <div class="button-group mt-auto">\
                <button type="button" class="btn-tambah">Tambah Matakuliah</button>\
                <button type="button" class="btn-hapus">Hapus Matakuliah</button>\
            </div>\
            </div>\
            </div>\
            <br>\
            <br>'
            $("#dynamic_form").append(addrow);
        };

        $("#dynamic_form").on("click", ".btn-tambah", function() {
            addForm()
            $(this).css("display", "none")
            let valtes = $(this).parent().find(".btn-hapus").css("display", "");
        })

        $("#dynamic_form").on("click", ".btn-hapus", function() {
            $(this).parent().parent('.baru-data').remove();
            let bykrow = $(".baru-data").length;
            if (bykrow == 1) {
                $(".btn-hapus").css("display", "none")
                $(".btn-tambah").css("display", "");
            } else {
                $('.baru-data').last().find('.btn-tambah').css("display", "");
            }
        });


        $('.btn-simpan').on('click', function() {
            $('#dynamic_form').find('input[type="text"], input[type="number"], select')
                .each(function() {
                    if ($(this).val() == "") {
                        event.preventDefault()
                        $(this).css('border-color', 'red');

                        $(this).on('focus', function() {
                            $(this).css('border-color', '#ccc');
                        });
                    }
                })
        })
    </script>
@endsection
