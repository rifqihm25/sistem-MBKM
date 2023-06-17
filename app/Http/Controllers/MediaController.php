<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Media;
use Illuminate\Support\Facades\Auth;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $media = Media::latest()->paginate(10);
        return view('user.upload.index', compact('media'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $siswa = Mahasiswa::leftjoin('media', 'mahasiswas.id', '=', 'media.mahasiswa_id')->where('user_id', $user->id)->firstOrFail();
        return view('user.upload.index', compact('siswa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $siswa = Mahasiswa::where('user_id', $user->id)->firstOrFail();

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pdf' => 'required|mimes:pdf|max:2048'
        ]);

        $data['image'] = null;
        $mhs = $request->only('pdf');

        if ($request->file('image')) { // check request image
            $data['image'] = $request->file('image')->store('images');
        }

        if ($request->hasFile('pdf')) { // check request file pdf
            $mhs['pdf'] = $request->pdf->getClientOriginalName();
            $request->pdf->storeAs('pdfs', $mhs['pdf']);
        }

        Media::create([
            'mahasiswa_id' => $siswa->id,
            'image' => $data['image'],
            'pdf' => $mhs['pdf'],
        ]);

        $siswa->update([
            'status' => 'Lengkap',
        ]);

        return redirect()->route('media.index')
            ->with('success', 'Berkas berhasil diunggah.');
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
}
