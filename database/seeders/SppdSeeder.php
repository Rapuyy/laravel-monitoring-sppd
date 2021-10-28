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
                'sppd_no' => 'AG2.TR.04.037',
                'ipa_no' => '002.00/7283/IX/2021',
                'pp_no' => '21994/PP/002/X/2021',
                'sppd_tujuan' => 'solo',
                'sppd_alasan' => 'mengantar Direksi',
                'sppd_kendaraan' => 'Kendaraan Dinas',
                'tgl_berangkat' => '2021-10-15',
                'tgl_pulang' => '2021-10-18',
            ]
        ]);
    }
}
