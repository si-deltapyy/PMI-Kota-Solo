<?php

namespace App\Http\Controllers;

use App\Models\KejadianBencana;
use App\Models\MobilisasiSd;
use App\Models\Personil;
use Illuminate\Http\Request;

class cekdata extends Controller
{
    public function index($id){

        $pengurus = Personil::sum('pengurus')+0;
        $markas = Personil::sum('staf_markas_kabkota') 
                + Personil::sum('staf_markas_prov') 
                + Personil::sum('staf_markas_pusat');

        $relawan = Personil::sum('relawan_pmi_kabkota') 
                + Personil::sum('relawan_pmi_prov') 
                + Personil::sum('relawan_pmi_linprov');

        $sukarelawan = Personil::sum('sukarelawan_sip')+0;

        $k = [
            'kk' => $pengurus,
            'jiwa' => $markas,
            'ringan' => $relawan,
            'mati' => $sukarelawan,

        ];
       

    if($k){
        return ["data" => $k, "message" => "berhasil"];
    }
    return ["message" => "error"];
    }
}
