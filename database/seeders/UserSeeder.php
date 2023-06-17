<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
use App\Models\Media;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = 'admin';
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make($password),
            'role' => 'admin',
        ]);

        // $siswa1 = Mahasiswa::create([
        //     'nama' => 'Dummy Mahasiswa',
        //     'email_mhs' => 'user@example.com',
        //     'npm' => '123456',
        //     'fakultas' => 'Teknik',
        //     'jurusan' => 'Rekayasa Perangkat Lunak',
        //     'semester' => '8',
        //     'ipk' => '1945',
        //     // 'jenis_mbkm' => 'Magang Merdeka',
        //     'status' => 'Belum Lengkap',
        // ]);

        // $user2 = User::create([
        //     'name' => $siswa1->nama,
        //     'email' => $siswa1->npm,
        //     'password' => Hash::make($siswa1->npm),
        //     'role' => 'user',
        // ]);

        // $siswa1->update([
        //     'user_id' => $user2->id,
        // ]);


        $this->command->info('Data Already Created!');
    }
}
