<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Mbkm;
use App\Models\Media;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $mhs = Mahasiswa::where('user_id', $user->id)->firstOrFail();
        $mbkm = Mbkm::all();
        return view('user.mahasiswa.input', compact('mhs', 'mbkm'), [
            'title' => 'Form Document'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.mahasiswa.input');
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
        $request->validate([
            'nama' => 'required',
            'email_mhs' => 'required|email',
            'npm' => 'required',
            'fakultas' => 'required',
            'jurusan' => 'required',
            'semester' => 'required|integer',
            'ipk' => 'required|numeric',
            'jenis_mbkm' => 'required',
            'no_telepon' => 'required|numeric',
            'tgl_daftar' => 'required',
            'periode_smt' => 'required',
        ]);

        $mbkm = Mbkm::where('mbkm_id', $request->jenis_mbkm)->first();

        $mhs = Mahasiswa::findOrFail($id);
        $requestData['mbkm_id'] = $mbkm['mbkm_id'];

        $mhs->update($requestData);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Berhasil melakukan pendaftaran.');
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

    public function profile()
    {
        $user = Auth::user();
        $mhs = Mahasiswa::leftjoin('media', 'mahasiswas.id', '=', 'media.mahasiswa_id')->where('user_id', $user->id)->firstOrFail();
        return view('user.profile.index', compact('mhs'));
    }

    public function updateProfile(Request $request, $id)
    {
        $data = $request->except('_token', '_method');
        $mhs = Mahasiswa::where('id', $id)->first();
        // $media = Media::where('mahasiswa_id', $mhs->id)->first();


        $validate = Validator::make(
            $data,
            [
                'nama' => 'required|max:191',
                'email_mhs' => ['required', 'email', Rule::unique('mahasiswas')->ignore($id, 'id')],
                'npm' => ['required', 'max:13', Rule::unique('mahasiswas')->ignore($id, 'id')],
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]
        );

        if ($validate->fails()) {
            return response()->json([
                'error' => $validate->errors()->toArray()
            ]);
        }

        if ($mhs != null) {
            $data['image'] = $mhs->foto_profil;
            if ($request->file('image')) {
                if ($mhs->foto_profil) {
                    Storage::delete($mhs->foto_profil);
                }
                $data['image'] = $request->file('image')->store('images');
            }
        }
        $mhs->update([
            'nama' => $data['nama'],
            'email_mhs' => $data['email_mhs'],
            'npm' => $data['npm'],
            'foto_profil' => $data['image'],
        ]);
        return back()->with("success", "Update profil berhasil!");
    }
}
