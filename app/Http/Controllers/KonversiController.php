<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konversi;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use PDF;


class KonversiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $mhs = Mahasiswa::leftjoin('konversis', 'mahasiswas.id', '=', 'konversis.mahasiswa_id')->leftjoin('mbkms', 'mahasiswas.mbkm_id', '=', 'mbkms.mbkm_id')->where('user_id', $user->id)->firstOrFail();
        $cek = Konversi::join('mahasiswas', 'konversis.mahasiswa_id', '=', 'mahasiswas.id')->first();
        // dd($cek, $mhs);

        if ($cek != null) {
            $konversi = Konversi::where('mahasiswa_id', $cek->id)->get();
            return view('user.konversi.detail', compact('mhs', 'konversi'));
        }

        return view('user.konversi.index', compact('mhs'));
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
        $requestData[] = $request->all();

        $user = Auth::user();
        $mhs = Mahasiswa::where('user_id', $user->id)->firstOrFail();

        $request->validate([
            'matakuliah' => 'required',
            'sks' => 'required',
            'nilai_mutu' => 'required',
        ]);

        $matakuliah = $request->matakuliah;
        $values = array();
        foreach ($matakuliah as $matkul => $id) {
            $values[] = [
                'mahasiswa_id'  => $mhs->id,
                'matakuliah' => $id,
                'sks'      => $request->sks[$matkul],
                'nilai_mutu' => $request->nilai_mutu[$matkul],
            ];
        }

        $cek = Konversi::insert($values);

        return redirect()->route('konversi.index')->with('success', 'Konversi berhasil diajukan.');
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

    public function cekKonversi()
    {
        $user = Auth::user();
        $mhs = Mahasiswa::leftjoin('konversis', 'mahasiswas.id', '=', 'konversis.mahasiswa_id')->where('user_id', $user->id)->first();
        $konversi = Konversi::where('mahasiswa_id', $mhs->id)->get();

        return view('user.konversi.detail', compact('mhs', 'konversi'));
    }

    public function exportKonversi()
    {
        $user = Auth::user();
        $mhs = Mahasiswa::leftjoin('konversis', 'mahasiswas.id', '=', 'konversis.mahasiswa_id')->leftjoin('mbkms', 'mahasiswas.mbkm_id', '=', 'mbkms.mbkm_id')->where('user_id', $user->id)->firstOrFail();
        $cek = Konversi::join('mahasiswas', 'konversis.mahasiswa_id', '=', 'mahasiswas.id')->first();
        $konversi = Konversi::where('mahasiswa_id', $cek->id)->get();

        $pdf = Pdf::loadView('user.konversi.laporan', compact('mhs', 'konversi'))->setPaper('a4', 'portrait');
        return $pdf->stream('Rekap Laporan MBKM.pdf');
    }
}
