<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('about')->insert([
            'name' => 'SAHABAT IKM',
            'logo' => '16869755214.png',
            'deskripsi' => 'membina dan mendampingi IKM melalui kegiatan Opimalisasi Teknologi dan Pendampingan Industri, maka dari itu untuk menggabungkan beberapa kegiatan pendampingan menjadi satu, diluncurkan program kegiatan Sahabat IKM yang bertujuan untuk memaksimalkan dalam pembinaan IKM dan kontribusi untuk kemajuan industri di Banua yang berdaya saing.',
            'alamat' => 'Jl. Panglima Batur No.2, Loktabat Utara, Kec. Banjarbaru Utara, Kota Banjar Baru, Kalimantan Selatan 70711',
            'email' => 'bspji.banjarbaru@gmail.com',
            'telepon' => '(0511) 4774861',
            'atas_nama' => 'Hamlan',
            'no_rekening' => '870-1231-3141',
        ]);
    }
}
