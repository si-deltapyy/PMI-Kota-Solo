<?php

namespace App\Charts;

use App\Models\Dampak;
use App\Models\KejadianBencana;
use App\Models\Personil;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class ExsumChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    } 
   
    public function build()
    {
        $currentYear = Carbon::now()->year;
        $dampakCounts = [];

        for ($month = 0; $month <= 11; $month++) {
            $dampakCounts[$month] = Dampak::whereYear('created_at', $currentYear)
                                        ->whereMonth('created_at', $month+1)
                                        ->count();
        }

        list(
            $dampak1, $dampak2, $dampak3, $dampak4, 
            $dampak5, $dampak6, $dampak7, $dampak8, 
            $dampak9, $dampak10, $dampak11, $dampak12
        ) = $dampakCounts;

        return $this->chart->areaChart()
        ->setTitle('Jumlah Dampak Tahun ' .$currentYear)
        ->setSubtitle('PMI Kota Solo ')
        ->addData('Jumlah Dampak', [
            $dampak1, $dampak2, $dampak3, $dampak4,$dampak5,$dampak6,
            $dampak7, $dampak8,$dampak9,$dampak10,$dampak11,$dampak12])
        ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'Aug', 'Sep', 'Okt', 'Nov', 'Des'])
        ->setColors(['#FFC107', '#303F9F']);
    }

    public function bar()
    {
        $currentYear = Carbon::now()->year;
        $jenisCount = [];

        for ($jenis = 0; $jenis <= 5; $jenis++) { 
            $jenisCount[$jenis] = KejadianBencana::where('id_jeniskejadian', $jenis + 1)->count();
        }

        list(
            $jenis1, $jenis2, $jenis3, $jenis4, $jenis5, $jenis6 
        ) = $jenisCount;

            
        
        return $this->chart->barChart()
        ->setTitle('Rekap Kejadian Bencana')
        ->setSubtitle('Tahun ' .$currentYear)
        ->addData('Total Kejadian', [$jenis1, $jenis2, $jenis3, $jenis4, $jenis5 , $jenis6 ])
        ->setXAxis(['Banjir', 'Gempa Bumi', 'Kebakaran', 'Longsor', 'Tsunami', 'Bangunan Runtuh']);
    }

    public function personil(){
        $currentYear = Carbon::now()->year;

        $pengurus = Personil::sum('pengurus')+0;
        $markas = Personil::sum('staf_markas_kabkota') 
                + Personil::sum('staf_markas_prov') 
                + Personil::sum('staf_markas_pusat');

        $relawan = Personil::sum('relawan_pmi_kabkota') 
                + Personil::sum('relawan_pmi_prov') 
                + Personil::sum('relawan_pmi_linprov');

        $sukarelawan = Personil::sum('sukarelawan_sip')+0;
        
        


        return $this->chart->pieChart()
        ->setTitle('Personil Mobilisasi')
        ->setSubtitle('Tahun ' .$currentYear)
        ->addData([ $pengurus, $markas, $sukarelawan, $relawan])
        ->setLabels(['Pengurusr', 'Staff Markas', 'Sukarelawan Spesialis', 'Relawan PMI']);
    }

    
}
