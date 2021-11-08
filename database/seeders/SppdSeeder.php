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
                'pegawai' => 'Pak Testi',
                'sppd_no' => 'AG2.TR.04.037',
                'ipa_no' => '002.00/7283/IX/2021',
                'pp_no' => '21994/PP/002/X/2021',
                'sppd_tujuan' => 'solo',
                'sppd_alasan' => 'mengantar Direksi',
                'sppd_kendaraan' => 'Kendaraan Dinas',
                'tgl_berangkat' => '2021-10-15',
                'tgl_pulang' => '2021-10-18',
                'status' => '0',
                'ipa_tgl_dibuat' => '2021-10-25',
                'ipa_tgl_selesai' => null,
                
            ],
            [
                'id' => '2',
                'pegawai' => 'Pak Testi, Bu Testi',
                'sppd_no' => 'AG2.TR.04.038',
                'ipa_no' => '002.00/7283/IX/2021',
                'pp_no' => '21994/PP/002/X/2021',
                'sppd_tujuan' => 'solo',
                'sppd_alasan' => 'mengantar Direksi',
                'sppd_kendaraan' => 'Kendaraan Dinas',
                'tgl_berangkat' => '2021-10-15',
                'tgl_pulang' => '2021-10-18',
                'status' => '1',
                'ipa_tgl_dibuat' => '2021-10-27',
                'ipa_tgl_selesai' => '2021-10-27',
            ],
            [
                'id' => '3',
                'pegawai' => 'Pak Testi',
                'sppd_no' => 'AG2.TR.04.039',
                'ipa_no' => '002.00/7283/IX/2021',
                'pp_no' => '21994/PP/002/X/2021',
                'sppd_tujuan' => 'solo',
                'sppd_alasan' => 'mengantar Direksi',
                'sppd_kendaraan' => 'Kendaraan Dinas',
                'tgl_berangkat' => '2021-10-15',
                'tgl_pulang' => '2021-10-18',
                'status' => '2',
                'ipa_tgl_dibuat' => '2021-10-30',
                'ipa_tgl_selesai' => '2021-10-31',
            ],
            [
                'id' => '4',
                'pegawai' => 'Pak Testi',
                'sppd_no' => 'AG2.TR.04.040',
                'ipa_no' => '002.00/7283/IX/2021',
                'pp_no' => '21994/PP/002/X/2021',
                'sppd_tujuan' => 'solo',
                'sppd_alasan' => 'mengantar Direksi',
                'sppd_kendaraan' => 'Kendaraan Dinas',
                'tgl_berangkat' => '2021-10-15',
                'tgl_pulang' => '2021-10-18',
                'status' => '3',
                'ipa_tgl_dibuat' => '2021-10-28',
                'ipa_tgl_selesai' => '2021-10-31',
            ],
            [
                'id' => '5',
                'pegawai' => 'Pak Testi',
                'sppd_no' => 'AG2.TR.04.041',
                'ipa_no' => '002.00/7283/IX/2021',
                'pp_no' => '21994/PP/002/X/2021',
                'sppd_tujuan' => 'solo',
                'sppd_alasan' => 'mengantar Direksi',
                'sppd_kendaraan' => 'Kendaraan Dinas',
                'tgl_berangkat' => '2021-10-15',
                'tgl_pulang' => '2021-10-18',
                'status' => '10',
                'ipa_tgl_dibuat' => '2021-10-19',
                'ipa_tgl_selesai' => '2021-11-01',
            ],
            [
                'id' => '6',
                'pegawai' => 'Pak Testi',
                'sppd_no' => 'AG2.TR.04.042',
                'ipa_no' => '002.00/7283/IX/2021',
                'pp_no' => '21994/PP/002/X/2021',
                'sppd_tujuan' => 'solo',
                'sppd_alasan' => 'mengantar Direksi',
                'sppd_kendaraan' => 'Kendaraan Dinas',
                'tgl_berangkat' => '2021-10-15',
                'tgl_pulang' => '2021-10-18',
                'status' => '11',
                'ipa_tgl_dibuat' => null,
                'ipa_tgl_selesai' => null,
            ],
            [
                'id' => '7',
                'pegawai' => 'Pak Testi',
                'sppd_no' => 'AG2.TR.04.043',
                'ipa_no' => '002.00/7283/IX/2021',
                'pp_no' => '21994/PP/002/X/2021',
                'sppd_tujuan' => 'solo',
                'sppd_alasan' => 'mengantar Direksi',
                'sppd_kendaraan' => 'Kendaraan Dinas',
                'tgl_berangkat' => '2021-10-15',
                'tgl_pulang' => '2021-10-18',
                'status' => '12',
                'ipa_tgl_dibuat' => null,
                'ipa_tgl_selesai' => null,
            ],
            [
                'id' => '8',
                'pegawai' => 'Pak Testi',
                'sppd_no' => 'AG2.TR.04.044',
                'ipa_no' => '002.00/7283/IX/2021',
                'pp_no' => '21994/PP/002/X/2021',
                'sppd_tujuan' => 'solo',
                'sppd_alasan' => 'mengantar Direksi',
                'sppd_kendaraan' => 'Kendaraan Dinas',
                'tgl_berangkat' => '2021-10-15',
                'tgl_pulang' => '2021-10-18',
                'status' => '13',
                'ipa_tgl_dibuat' => null,
                'ipa_tgl_selesai' => null,
            ],
        ]);
    }
}
