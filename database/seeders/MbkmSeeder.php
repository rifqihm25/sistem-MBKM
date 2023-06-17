<?php

namespace Database\Seeders;

use App\Models\Mbkm;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MbkmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas =
            [
                'Kampus Mengajar',
                'Magang Studi Independent Bersertifikat',
                'Pertukaran Mahasiswa Merdeka',
                'Wirausaha Merdeka',
                'Indonesian International Student Mobility Awards',
                'Praktisi Mengajar',
                'Bangkit by Google, GoTo, and Traveloka',
                'GERILYA',
            ];

        foreach ($datas as $data) {
            Mbkm::create([
                'nama_mbkm' => $data,
            ]);
        }
    }
}
