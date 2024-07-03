<?php

namespace App\Http\Controllers;

use App\Models\LayananKorban;
use App\Models\KejadianBencana;
use App\Models\Personil;
use Illuminate\Http\Request;

class cekdata extends Controller
{
    public function index($id){

        $k = KejadianBencana::join('jenis_kejadian', 'kejadian_bencana.id_jeniskejadian', '=', 'jenis_kejadian.id_jeniskejadian')->get();

    if($k){
        return ["data" => $k, "message" => "berhasil"];
    }
    return ["message" => "error"];
    }
}
