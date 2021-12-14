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
        'keterangan',
        'status',
        'tgl_berangkat',
        'tgl_pulang'
    ];
}
