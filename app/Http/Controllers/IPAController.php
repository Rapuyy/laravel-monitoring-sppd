<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IPA;
use Illuminate\Support\Facades\DB;

class IPAController extends Controller
{
    public function getIPA()
    {
        return IPA::all();
    }
}
