<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sppd extends Model
{
    use HasFactory;

    protected $table = 'sppd';

    public $primaryKey = 'id';

    public $timestamp = true;
    
    protected $fillable = [
        'sppd_no',
        'ipa_no',
        'pp_no',
        'pegawai',
        'sppd_tujuan',
        'sppd_alasan',
        'sppd_kendaraan',
        'sppd_tgl_msk',
        'op_pengisi',
        'unit_kerja',
        'ipa_nilai',
        'sumber_dana',
        'keterangan',
        'status',
        'tgl_berangkat',
        'tgl_pulang',
        'ipa_tgl_dibuat',
        'ipa_tgl_diajukan',
        'ipa_tgl_approval',
        'ipa_tgl_msk_finance',
        'ipa_tgl_selesai',
        'pp_tgl_dibuat',
        'pp_tgl_diajukan',
        'pp_tgl_approval',
        'pp_tgl_msk_finance',
        'pp_tgl_selesai'
    ];
}
