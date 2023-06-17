<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MasterDosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dsn = Mahasiswa::rightjoin('dosens', 'mahasiswas.dosen_penguji_id', '=', 'dosens.dosen_id')->where('status', 'Lengkap')->get();

        return view('admin.dosen.index', compact('dsn'));
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
        $requestData = $request->all();
        $mhs = Mahasiswa::where('id', $id)->first();
        $dsn = Dosen::where('dosen_id', $mhs->dosen_penguji_id)->first();


        $validate = Validator::make(
            $requestData,
            [
                'nama_dosen' => 'required',
                'email_dosen' => ['required', 'email', Rule::unique('dosens')->ignore($dsn->dosen_id, 'dosen_id')],
                'nik' => ['required', 'max:13', Rule::unique('dosens')->ignore($dsn->dosen_id, 'dosen_id')],
            ]
        );

        if ($validate->fails()) {
            return back()->with('error', 'Cek kembali berkas yang anda submit!');
        }

        $dsn->update($requestData);

        return redirect()->route('master-mhs-dsn.index')
            ->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $where = Mahasiswa::where('id', $id)->firstOrFail();

            $dsn = Dosen::where('dosen_id', $where->dosen_penguji_id)->get();


            foreach ($dsn as $dsn) {
                Dosen::where('dosen_id', $dsn->dosen_id)->delete();
            }

            $where->update([
                'status_mhs' => null,
            ]);

            return back()->with('success', 'Data telah dihapus');
        } catch (\Exception $e) {
            return response()->json(["error" => true, "message" => $e->getMessage()]);
        }
    }
}
