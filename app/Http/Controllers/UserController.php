<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Mahasiswa::join('users', 'mahasiswas.user_id', '=', 'users.id')->get();

        return view('admin.user-page.index', compact('user'));
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
        $requestData = $request->all();

        $mhsData = $requestData;

        $validate = Validator::make($requestData, [
            'nama' => 'required|string|max:75',
            'email_mhs' => 'required|unique:mahasiswas',
            'npm' => 'required',
            // 'password' => 'required',
            'role' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'error' => $validate->errors()->toArray()
            ]);
        }

        $userData = User::create([
            'name' => $request->nama,
            'email' => $request->npm,
            'password' => Hash::make($request->npm),
            'role' => $request->role,
        ]);
        $mhsData['user_id'] = $userData->id;
        Mahasiswa::create($mhsData);

        return back()->with('success', 'Data user berhasil ditambah');
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
        $requestData = $request->only('nama', 'email_mhs', 'npm', 'role', 'user_id');

        $validasi = $request->validate([
            'nama' => 'required|string|max:75',
            'email_mhs' => 'required',
            'npm' => 'required',
            'role' => 'required'
        ]);

        $mhs = Mahasiswa::leftjoin('users', 'mahasiswas.user_id', '=', 'users.id')->where('user_id', $id)->first();
        $mhsw = Mahasiswa::where('user_id', $request->user_id)->get();

        if ($request->email_mhs != $mhs->email_mhs) {
            foreach ($mhsw as $mhsw) {
                if ($requestData['email_mhs'] == $mhsw->email_mhs && $requestData['npm'] == $mhsw->email) {
                    return response()->json([
                        "error" => true,
                        "message" => "The data have already been taken",
                    ]);
                }
            };
        }

        $findUser = User::where('id', $mhs->user_id);
        $dataMhs = Mahasiswa::where('user_id', $request->user_id)->first();

        $findUser->update([
            'name' => $request->nama,
            'email' => $request->npm,
            'password' => Hash::make($request->npm),
            'role' => $request->role,
        ]);

        $dataMhs->update([
            'nama' => $requestData['nama'],
            'email_mhs' => $requestData['email_mhs'],
            'npm' => $requestData['npm'],
        ]);

        if ($mhs) {
            return back()->with('success', 'Data user berhasil diupdate');
        } else {
            return back()->with('error', 'Data user gagal diupdate');
        }
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
            $where = Mahasiswa::where('user_id', $id)->first();

            $mhs = Mahasiswa::where('user_id', $where->user_id)->get();

            foreach ($mhs as $mhs) {
                User::where('id', $mhs->user_id)->delete();
            }

            Mahasiswa::where('user_id', $mhs->user_id)->delete();

            return back()->with('success', 'Data user berhasil dihapus');
        } catch (\Exception $e) {
            return response()->json(["error" => true, "message" => $e->getMessage()]);
        }
    }
}
