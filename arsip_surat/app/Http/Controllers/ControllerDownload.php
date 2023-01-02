<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class ControllerDownload extends Controller
{
    public function downloadfunc()
    {
        $surat = Surat::all();
        return view('dashboard.index', compact('surat'));
    }
}
