<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Checkin;
use App\Models\User;
use App\Models\Task;
use Carbon\Carbon;

class ComplianceChart extends Component
{
    public $labels = [];
    public $data = [];

    public function mount()
    {
        $this->loadChartData();
    }

    public function loadChartData()
    {
        $endDate = Carbon::today();
        $startDate = Carbon::today()->subDays(6); // 7 hari total

        // 1. Dapatkan "pembagi"-nya: Berapa total peserta?
        // Kita gunakan '->count()' agar efisien
        $totalParticipants = User::where('role', 'participant')->count();

        // 2. Dapatkan "pembilang"-nya: Berapa BANYAK PESERTA UNIK
        //    yang ceklis setiap hari?
        $actualCheckins = Checkin::whereBetween('date', [$startDate, $endDate])
            ->select(
                'date',
                // Perubahan utamanya di sini:
                // Kita tidak lagi COUNT(*), tapi COUNT(DISTINCT user_id)
                DB::raw('COUNT(DISTINCT user_id) as daily_participants')
            )
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->keyBy('date'); // Jadikan tanggal sebagai key

        // 3. Siapkan array data untuk 7 hari
        $this->labels = [];
        $this->data = [];

        for ($date = $startDate->copy(); $date <= $endDate; $date->addDay()) {
            $dateString = $date->toDateString();
            
            $this->labels[] = $date->format('d M');
            
            // Ambil jumlah peserta unik yang ceklis hari itu
            $participantCount = $actualCheckins[$dateString]->daily_participants ?? 0;

            // 4. Hitung persentase (dan hindari error "dibagi nol")
            if ($totalParticipants > 0) {
                $compliancePercent = ($participantCount / $totalParticipants) * 100;
            } else {
                $compliancePercent = 0;
            }
            
            $this->data[] = round($compliancePercent, 1);
        }
    }

    public function render()
    {
        return view('livewire.admin.compliance-chart');
    }
}