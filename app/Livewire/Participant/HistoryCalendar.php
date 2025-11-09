<?php

namespace App\Livewire\Participant;

use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Checkin;
use App\Models\Task;

class HistoryCalendar extends Component
{
    public $userId = null;
    public $currentDate;
    public $daysInMonth;
    public $startOfMonth;
    public $monthName;
    
    // Ini akan menyimpan data kalender
    public $calendarGrid = [];
    
    // Ini akan menyimpan statistik kepatuhan
    public $complianceData = [];
    public $totalTasks;

    public function mount()
    {
        if (is_null($this->userId)) {
            $this->userId = Auth::id();
        }

        $this->currentDate = Carbon::today();
        $this->totalTasks = Task::count(); // Hitung total tugas sekali saja
        $this->generateCalendar();
    }

    /**
     * Pindah ke bulan sebelumnya.
     */
    public function goToPreviousMonth()
    {
        $this->currentDate->subMonth();
        $this->generateCalendar();
    }

    /**
     * Pindah ke bulan berikutnya.
     */
    public function goToNextMonth()
    {
        $this->currentDate->addMonth();
        $this->generateCalendar();
    }

    /**
     * Logika utama untuk membuat kalender.
     */
    public function generateCalendar()
    {
        $this->monthName = $this->currentDate->format('F Y');
        $this->daysInMonth = $this->currentDate->daysInMonth;
        $this->startOfMonth = $this->currentDate->copy()->startOfMonth()->dayOfWeek; // 0=Min, 1=Sen, ...

        // 1. Ambil data check-in untuk bulan ini
        $startDate = $this->currentDate->copy()->startOfMonth();
        $endDate = $this->currentDate->copy()->endOfMonth();
        
$checkins = Checkin::where('user_id', $this->userId) // <-- SUDAH DIUBAH
            ->whereBetween('date', [$startDate, $endDate])
            ->get()            
            // Kelompokkan berdasarkan tanggal
            ->groupBy(function($date) {
                return Carbon::parse($date->date)->format('j'); // 'j' = 1 s/d 31
            });

        // 2. Siapkan array kosong
        $this->calendarGrid = [];
        $dayCounter = 1;

        // 3. Buat 6 baris (minggu)
        for ($i = 0; $i < 6; $i++) {
            $week = [];
            
            // 4. Buat 7 kolom (hari)
            for ($j = 0; $j < 7; $j++) {
                // Jika ini adalah sel kosong sebelum tanggal 1
                if ($i === 0 && $j < $this->startOfMonth) {
                    $week[] = ['day' => '', 'status' => 'empty'];
                } 
                // Jika hari sudah melebihi jumlah hari di bulan ini
                elseif ($dayCounter > $this->daysInMonth) {
                    $week[] = ['day' => '', 'status' => 'empty'];
                } 
                // Ini adalah hari yang valid
                else {
                    $status = 'none'; // Default: tidak ada check-in
                    
                    if (isset($checkins[$dayCounter])) {
                        $checkinsForDay = $checkins[$dayCounter]->count();
                        
                        // Tentukan status berdasarkan jumlah check-in
                        if ($checkinsForDay >= $this->totalTasks) {
                            $status = 'full'; // Kepatuhan penuh (hijau)
                        } else {
                            $status = 'partial'; // Kepatuhan sebagian (kuning)
                        }
                    }
                    
                    $week[] = ['day' => $dayCounter, 'status' => $status];
                    $dayCounter++;
                }
            }
            $this->calendarGrid[] = $week;
        }
    }

    public function render()
    {
        return view('livewire.participant.history-calendar')
            ->layout('layouts.app');
    }
}