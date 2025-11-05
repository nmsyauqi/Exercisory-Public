<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Task;
use App\Models\User;
use App\Models\Checkin;
use Carbon\Carbon;
use Livewire\Attributes\On;

class TaskManager extends Component
{
    // Properti untuk form
    public $name;
    public $points;

    // Properti untuk manajemen state
    public $selected_task_id;
    public $isEditing = false;

    // Aturan validasi
    protected $rules = [
        'name' => 'required|string|min:3|max:255',
        'points' => 'required|integer|min:1',
    ];

    /**
     * Menangani submit form (baik create maupun update)
     */
    public function save()
    {
        $this->validate();

        Task::updateOrCreate(
            ['id' => $this->selected_task_id], // Kunci pencarian
            [
                'name' => $this->name,         // Data untuk di-update atau create
                'points' => $this->points
            ]
        );

        session()->flash('message', $this->isEditing ? 'Tugas berhasil diperbarui.' : 'Tugas baru berhasil ditambahkan.');
        $this->resetForm();
    }

    /**
     * Masuk ke mode edit dan mengisi form dengan data
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $this->selected_task_id = $task->id;
        $this->name = $task->name;
        $this->points = $task->points;
        $this->isEditing = true;
    }

    /**
     * Menghapus tugas
     */
    public function delete($id)
    {
        try {
            Task::findOrFail($id)->delete();
            session()->flash('message', 'Tugas berhasil dihapus.');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menghapus tugas. Mungkin terkait dengan data lain.');
        }
        $this->resetForm(); // Reset form jika user sedang mengedit item yang dihapus
    }

    /**
     * Mereset properti form
     */
    public function resetForm()
    {
        $this->reset(['name', 'points', 'selected_task_id', 'isEditing']);
    }

    /**
     * Render komponen
     */

    public function render()
    {
        // --- LOGIKA STATISTIK BARU ---
        $totalParticipants = User::where('role', 'participant')->count();
        $totalTasks = Task::count();
        $totalCheckinsToday = Checkin::where('date', Carbon::today()->toDateString())->count();
        // --- SELESAI LOGIKA STATISTIK ---
        
        // Logika lama Anda untuk tabel
        $tasks = Task::orderBy('created_at', 'desc')->get();
        
        return view('livewire.admin.task-manager', [
            'tasks' => $tasks,
            
            // --- KIRIM DATA STATISTIK KE VIEW ---
            'totalParticipants' => $totalParticipants,
            'totalTasks' => $totalTasks,
            'totalCheckinsToday' => $totalCheckinsToday,
            
        ])->layout('layouts.app'); // Asumsi Anda menggunakan layout default Laravel
    }


    public function create()
    {
        $this->resetForm();
    }
    #[On('data-updated')]
    public function refreshStats()
{
    // Method render() sudah berisi logika statistik,
    // jadi kita hanya perlu memaksanya render ulang.
    // Method kosong ini sudah cukup untuk memicunya.
}
}
