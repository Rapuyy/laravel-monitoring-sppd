<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PP extends Model
{
    use HasFactory;
    
    protected $table = 'pp';

    public $primaryKey = 'id';

    public $timestamp = true;
    
    protected $fillable = [
        'pp_no',
        'pp_tgl_dibuat',
        'pp_tgl_diajukan',
        'pp_tgl_approval',
        'pp_tgl_msk_finance',
        'pp_tgl_selesai'
    ];
}
