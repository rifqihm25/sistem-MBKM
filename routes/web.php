<?php

use App\Http\Controllers\Admin\MasterDosenController;
use App\Http\Controllers\Admin\MasterKonversiController;
use App\Http\Controllers\Admin\MasterMahasiswaController;
use App\Http\Controllers\Admin\MasterMBKMController;
use App\Http\Controllers\AdminDosenController;
use App\Http\Controllers\ArchiveController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KonversiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Login
Auth::routes();

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/', [LoginController::class, 'responseIndex']);

// For Admin
Route::group(['middleware' => ['auth', 'admin']], function () {
    // Dashboard
    Route::resource('dashboard', DashboardController::class);

    // Mahasiswa
    Route::resource('/master-mahasiswa', MasterMahasiswaController::class);
    Route::put('master-mahasiswa/arsip/{id}', [MasterMahasiswaController::class, 'archive'])->name('archive');
    Route::get('pdf/{mahasiswa_id}/download', [MasterMahasiswaController::class, 'downloadFile'])->name('pdf.download');

    // Rekap
    Route::get('laporan/mahasiswa', [LaporanController::class, 'viewMhsPDF'])->name('view-pdf');
    Route::get('laporan-dosen', [LaporanController::class, 'viewDsnPDF'])->name('view-pdfdosen');
    Route::get('laporan-konversi', [LaporanController::class, 'viewKonversiPDF'])->name('view-pdfkonversi');
    Route::get('laporan-mbkm', [LaporanController::class, 'viewMbkmPDF'])->name('view-pdfmbkm');

    // Archive
    Route::resource('arsip', ArchiveController::class);
    Route::put('arsip/mahasiswa/{id}', [ArchiveController::class, 'pulihMahasiswa'])->name('pulih-mahasiswa');

    // Dosen
    Route::resource('master-mhs-dsn', MasterDosenController::class);

    // Konversi
    Route::resource('master-konversi', MasterKonversiController::class);

    // Setting User
    Route::resource('user-page', UserController::class);

    // MBKM
    Route::resource('mbkm', MasterMBKMController::class);
});

// For User
Route::group(['middleware' => ['auth', 'user']], function () {
    // Beranda
    Route::get('/beranda', [BerandaController::class, 'index']);
    Route::get('cek-konversi', [BerandaController::class, 'convertion'])->name('cek-konversi');

    // Mahasiswa
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
    Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
    Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');

    // Profile Mahasiswa
    Route::get('/profile', [MahasiswaController::class, 'profile'])->name('profile');
    Route::put('profile/{id}', [MahasiswaController::class, 'updateProfile'])->name('updateProfile');

    // Upload
    Route::get('/upload-index', [UploadController::class, 'index'])->name('upload-index');
    Route::post('/upload', [UploadController::class, 'upload'])->name('upload');

    // Dosen
    Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.index');
    Route::post('/dosen', [DosenController::class, 'store'])->name('dosen.store');

    // Konversi
    Route::resource('/konversi', KonversiController::class);
    Route::get('export-konversi', [KonversiController::class, 'exportKonversi'])->name('export-konversi');

    // Media
    Route::resource('media', MediaController::class);

    // Cek Konversi
    Route::get('preview-konversi', [KonversiController::class, 'cekKonversi']);

    Route::get('/download-pdf1', function () {
        $path = 'storage\pdfs\INFORMASI KAMPUS MENGAJAR.pdf';
        $filename = 'INFORMASI KAMPUS MENGAJAR.pdf';

        if (File::exists($path)) {
            return Response::download($path, $filename);
        } else {
            abort(404, 'File not found');
        }
    })->name('download.pdf1');

    Route::get('/download-pdf2', function () {
        $path = 'storage\pdfs\SYARAT DAN KETENTUAN KAMPUS MENGAJAR.pdf';
        $filename = 'SYARAT DAN KETENTUAN KAMPUS MENGAJAR.pdf';

        if (File::exists($path)) {
            return Response::download($path, $filename);
        } else {
            abort(404, 'File not found');
        }
    })->name('download.pdf2');
});
