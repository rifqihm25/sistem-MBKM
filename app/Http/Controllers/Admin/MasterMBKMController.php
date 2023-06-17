<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Konversi;
use App\Models\Mahasiswa;
use App\Models\Mbkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterMBKMController extends Controller
{
    public function index(Request $request)
    {
        if ($request->date != null) {
            $mbkms = Mbkm::orderby('nama_mbkm', 'asc')->get();

            $data = array();
            foreach ($mbkms as $key => $mbkm) {
                $mhs = Mahasiswa::join('mbkms', 'mahasiswas.mbkm_id', '=', 'mbkms.mbkm_id')
                    ->whereDate('tgl_daftar', $request->date)
                    ->where('mahasiswas.mbkm_id', $mbkm->mbkm_id)
                    ->count();
                $data[] = [
                    'nama_mbkm' => $mbkm->nama_mbkm,
                    'jumlah' => $mhs,
                ];
            }
            $let = null;

            return view('admin.mbkm.index', compact('mbkms', 'let', 'mhs', 'data'));
        }
        $let = 1;

        $mbkms = Mbkm::withCount('mahasiswas')->orderby('nama_mbkm', 'asc')->get();

        return view('admin.mbkm.index', compact('mbkms', 'let'));
    }
}
