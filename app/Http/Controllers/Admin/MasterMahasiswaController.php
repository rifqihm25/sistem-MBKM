<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Mbkm;
use App\Models\Media;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PhpParser\Node\Stmt\TryCatch;

class MasterMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mhs = Mahasiswa::join('mbkms', 'mahasiswas.mbkm_id', '=', 'mbkms.mbkm_id')->where('status_data', null)->get();
        $lengkap = 'Lengkap';
        $blmlengkap = 'Belum Lengkap';
        // $mbkm = Mbkm::all();
        return view('admin.mahasiswa.index', compact('mhs', 'lengkap', 'blmlengkap'));
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
        $mhs = Mahasiswa::leftjoin('media', 'mahasiswas.id', '=', 'media.mahasiswa_id')->find($id);
        $lengkap = 'Lengkap';
        $blmlengkap = 'Belum Lengkap';

        return view('admin.mahasiswa.detail', compact('mhs', 'lengkap', 'blmlengkap'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mhs = Mahasiswa::leftjoin('media', 'mahasiswas.id', '=', 'media.mahasiswa_id')->find($id);

        return view('admin.mahasiswa.edit', compact('mhs'));
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
        $data = $request->except('_token', '_method');
        $mhs = Mahasiswa::where('id', $id)->first();
        $media = Media::where('mahasiswa_id', $mhs->id)->first();

        $validate = Validator::make(
            $data,
            [
                'pdf' => 'required|mimes:pdf|max:2048',
                'image' => 'required|file|image|max:2048',
            ]
        );

        if ($validate->fails()) {
            return back()->with('error', 'Cek kembali berkas yang anda submit!');
        }

        if ($media != null) {
            $data['image'] = $media->image;
            $data['pdf'] = $media->pdf;
            if ($request->file('image') || $request->hasFile('pdf')) {
                if ($media->image) {
                    Storage::delete($media->image);
                }
                $data['image'] = $request->file('image')->store('images');

                if ($media->pdf) {
                    Storage::delete($media->pdf);
                }
                $data['pdf'] = $request->pdf->getClientOriginalName();
                $request->pdf->storeAs('pdfs', $data['pdf']);
            }
            $media->update([
                'image' => $data['image'],
                'pdf' => $data['pdf'],
            ]);
        } else {
            if ($request->file('image')) { // check request image
                $data['image'] = $request->file('image')->store('images');
            }
            if ($request->hasFile('pdf')) { // check request file pdf
                $mhs['pdf'] = $request->pdf->getClientOriginalName();
                $request->pdf->storeAs('pdfs', $mhs['pdf']);
            }
            Media::create([
                'mahasiswa_id' => $mhs->id,
                'image' => $data['image'],
                'pdf' => $data['pdf'],
            ]);
        }

        $mhs->update([
            'status' => 'Lengkap',
        ]);

        return redirect()->route('master-mahasiswa.index')->with('success', 'Data berhasil diupdate');
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
            $where = Mahasiswa::where('id', $id)->first();
            $mhs = Mahasiswa::where('id', $where->id)->get();

            foreach ($mhs as $mhs) {
                Media::where('mahasiswa_id', $mhs->id)->delete();
            }

            Mahasiswa::where('id', $mhs->id)->delete();

            return back()->with('success', 'Data berkas mahasiswa dihapus');
        } catch (\Exception $e) {
            return response()->json(["error" => true, "message" => $e->getMessage()]);
        }
    }

    /**
     * Arsip the specified resource from storage.
     */
    public function archive(Request $request, $id)
    {
        $mhs = Mahasiswa::findOrFail($id);
        $mhs->update([
            'status_data' => 'Archive',
        ]);

        if ($mhs) {
            return back()->with("success", "Data telah diarsip!");
        } else {
            return back()->with("error",  "Data tidak ada!");
        }
    }

    public function downloadFile($mahasiswa_id)
    {

        $mhs = Mahasiswa::leftjoin('media', 'mahasiswas.id', '=', 'media.mahasiswa_id')->where('mahasiswa_id', $mahasiswa_id)->firstOrFail();
        try {
            $pathToFile = public_path('storage/pdfs/' . $mhs->pdf);
            return response()->download($pathToFile);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
