<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IPA extends Model
{
    use HasFactory;

    protected $table = 'ipa';

    public $primaryKey = 'id';

    public $timestamp = true;
    
    protected $fillable = [
        'ipa_no',
        'ipa_nilai',
        'sumber_dana',
        'ipa_tgl_dibuat',
        'ipa_tgl_diajukan',
        'ipa_tgl_approval',
        'ipa_tgl_msk_finance',
        'ipa_tgl_selesai',
        'ipa_status'
    ];
}
