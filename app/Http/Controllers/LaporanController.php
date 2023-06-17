<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Mbkm;
use App\Models\Siswa;
use PDF;


class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function viewMhsPDF()
    {
        $mhs = Mahasiswa::join('mbkms', 'mahasiswas.mbkm_id', '=', 'mbkms.mbkm_id')->where('status_data', null)->get();
        $lengkap = 'Lengkap';
        $blmlengkap = 'Belum Lengkap';
        $pdf = Pdf::loadView('admin.laporan.laporan-mhs', compact('mhs', 'lengkap', 'blmlengkap'))->setPaper('a4', 'portrait')->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path()
        ]);
        return $pdf->stream('Rekap Laporan MBKM Mahasiswa.pdf');
    }

    public function downloadPDF()
    {
        $mhs = Mahasiswa::all();
        $lengkap = 'Lengkap';
        $blmlengkap = 'Belum Lengkap';
        $pdf = Pdf::loadView('admin.laporan.laporan-mhs', array('mhs' =>  $mhs, 'lengkap' => $lengkap, 'blmlengkap' => $blmlengkap))
            ->setPaper('a4', 'portrait');

        return $pdf->download('Rekap Laporan MBKM Mahasiswa.pdf');
    }

    public function viewDsnPDF()
    {
        $dsn = Mahasiswa::leftjoin('dosens', 'mahasiswas.dosen_penguji_id', '=', 'dosens.dosen_id')->where('status', 'Lengkap')->get();
        $pdf = Pdf::loadView('admin.laporandosen.laporan-dosen', compact('dsn'))->setPaper('a4', 'portrait');
        return $pdf->stream('Rekap Laporan Dosen.pdf');
    }

    public function downloadDsnPDF()
    {
        $dsn = Mahasiswa::leftjoin('dosens', 'mahasiswas.dosen_penguji_id', '=', 'dosens.id')->where('status', 'Lengkap')->get();

        $pdf = Pdf::loadView('admin.laporandosen.laporan-dosen', array('dsn' =>  $dsn))
            ->setPaper('a4', 'portrait');

        return $pdf->download('Rekap Laporan Dosen.pdf');
    }

    public function viewKonversiPDF()
    {
        $konversi = Mahasiswa::where('status', 'Lengkap')->get();
        $pdf = Pdf::loadView('admin.laporan-konversi.laporan-konversi', compact('konversi'))->setPaper('a4', 'portrait');
        return $pdf->stream('Rekap Laporan Konversi.pdf');
    }

    public function downloadKonversiPDF()
    {
        $konversi = Mahasiswa::where('status', 'Lengkap')->get();

        $pdf = Pdf::loadView('admin.laporan-konversi.laporan-konversi', array('konversi' =>  $konversi))
            ->setPaper('a4', 'portrait');

        return $pdf->download('Rekap Laporan Konversi.pdf');
    }

    public function viewMbkmPDF()
    {
        $mbkms = Mbkm::withCount('mahasiswas')->orderby('nama_mbkm', 'asc')->get();
        $pdf = Pdf::loadView('admin.laporan-mbkm.index', compact('mbkms'))->setPaper('a4', 'portrait');
        return $pdf->stream('Rekap Laporan MBKM.pdf');
    }
}
