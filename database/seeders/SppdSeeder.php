<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SppdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sppd')->insert([
            [
                'id' => '1',
                'ipa_no' => null,
                'pp_no' => null,
                'op_pengisi' => 'Ady',
                'pegawai' => 'dummy test',
                'unit_kerja' => 'HCGA',
                'sppd_no' => 'AG2.TR.04.037',
                'sppd_tujuan' => 'solo',
                'sppd_alasan' => 'mengantar Direksi',
                'sppd_kendaraan' => 'Kendaraan Dinas',
                'tgl_berangkat' => '2021-10-15',
                'tgl_pulang' => '2021-10-18',
                'sppd_tgl_msk' => '2022-01-19',
                'status' => '0',
            ],
        ]);

        DB::table('users')->insert([
            [
                'id' => '1',
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => '$2y$10$1FPo/sm8iqvgKHXfU8cQF.1bMzzKwnsZK/ngrkyZhoDXhVg4K2zCS', //admin123
            ],
        ]);
    }
}
