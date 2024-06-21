<?php

namespace App\Charts;

use App\Models\Dampak;
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
        ->setTitle('Jumlah Bencana ' .$currentYear)
        ->setSubtitle('PMI Kota Solo ')
        ->addData('Jumlah Dampak', [
            $dampak1, $dampak2, $dampak3, $dampak4,$dampak5,$dampak6,
            $dampak7, $dampak8,$dampak9,$dampak10,$dampak11,$dampak12])
        ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'Aug', 'Sep', 'Okt', 'Nov', 'Des'])
        ->setColors(['#FFC107', '#303F9F']);
    }
    
}
