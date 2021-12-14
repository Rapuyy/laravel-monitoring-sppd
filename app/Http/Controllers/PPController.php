<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PP;
use Illuminate\Support\Facades\DB;

class PPController extends Controller
{
    public function getPP()
    {
        return PP::all();
    }
}
