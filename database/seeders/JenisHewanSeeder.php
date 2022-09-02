<?php

namespace Database\Seeders;

use App\Models\JenisHewan;
use Illuminate\Database\Seeder;

class JenisHewanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $NamaJenis = 
        [
            'Kucing',
            'Anjing',
            'Burung',
            'Ikan'
        ];


        foreach ($NamaJenis as $data) {
            JenisHewan::create(['nama_jenis' => $data]);
        }
    }
}
