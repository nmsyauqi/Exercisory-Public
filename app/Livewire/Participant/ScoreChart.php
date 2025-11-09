<?php

namespace App\Livewire\Participant;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Checkin;
use Carbon\Carbon;

class ScoreChart extends Component
{
    public $labels = [];
    public $data = [];
    public $userId = null;

    public function mount()
    {
        if (is_null($this->userId)) {
            $this->userId = Auth::id();
        }
        
        $this->loadChartData();
    }

    public function loadChartData()
    {
        $userId = $this->userId;
        $endDate = Carbon::today();
        $startDate = Carbon::today()->subDays(6); // 7 hari total

        // 1. Query untuk mengambil total skor, dikelompokkan per hari
        $scores = Checkin::join('tasks', 'checkins.task_id', '=', 'tasks.id')
            ->where('checkins.user_id', $userId)
            ->whereBetween('checkins.date', [$startDate, $endDate])
            ->select(
                'checkins.date',
                DB::raw('SUM(tasks.points) as daily_score')
            )
            ->groupBy('checkins.date')
            ->orderBy('checkins.date', 'asc')
            ->get()
            ->keyBy('date'); // Jadikan tanggal sebagai key (kunci)

        // 2. Siapkan array data untuk 7 hari (termasuk hari yang skornya 0)
        $this->labels = [];
        $this->data = [];

        // Loop dari 7 hari lalu sampai hari ini
        for ($date = $startDate->copy(); $date <= $endDate; $date->addDay()) {
            $dateString = $date->toDateString();
            
            // Tambahkan label (misal: "05 Nov")
            $this->labels[] = $date->format('d M');
            
            // Cek apakah ada skor di tanggal ini
            if (isset($scores[$dateString])) {
                $this->data[] = $scores[$dateString]->daily_score;
            } else {
                // Jika tidak ada, skornya 0
                $this->data[] = 0;
            }
        }
    }

    public function render()
    {
        return view('livewire.participant.score-chart');
    }
}
