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

        // ambil total peserta
        $totalParticipants = User::where('role', 'participant')->count();

        // ambil data checkin peserta unik
        $actualCheckins = Checkin::whereBetween('date', [$startDate, $endDate])
            ->select(
                'date',
                DB::raw('COUNT(DISTINCT user_id) as daily_participants')
            )
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->keyBy('date'); // jadikan tanggal sebagai key

        // siapkan array
        $this->labels = [];
        $this->data = [];

        for ($date = $startDate->copy(); $date <= $endDate; $date->addDay()) {
            $dateString = $date->toDateString();
            
            $this->labels[] = $date->format('d M');
            
            // ambil jumlah peserta harian
            $participantCount = $actualCheckins[$dateString]->daily_participants ?? 0;

            // hitung persentase
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