<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Task;
use App\Models\User;
use App\Models\Checkin;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Livewire\WithPagination;


class TaskManager extends Component
{
    // properti untuk form
    public $name;
    public $points;
    public $today;

    // properti untuk manajemen state
    public $selected_task_id;
    public $isEditing = false;

    // validasi
    protected $rules = [
        'name' => 'required|string|min:3|max:255',
        'points' => 'required|integer|min:1',
    ];

    // submit tugas create atau update
    public function save()
    {
        $this->validate();

        Task::updateOrCreate(
            ['id' => $this->selected_task_id], // pencarian
            [
                'name' => $this->name,         // data yang create atau update
                'points' => $this->points
            ]
        );

        session()->flash('message', $this->isEditing ? 'Tugas berhasil diperbarui.' : 'Tugas baru berhasil ditambahkan.');
        $this->resetForm();
    }

    // edit tugas
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $this->selected_task_id = $task->id;
        $this->name = $task->name;
        $this->points = $task->points;
        $this->isEditing = true;
    }

    // hapus tugas
    public function delete($id)
    {
        try {
            Task::findOrFail($id)->delete();
            session()->flash('message', 'Tugas berhasil dihapus.');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menghapus tugas. Mungkin terkait dengan data lain.');
        }
        $this->resetForm(); // reset form jika user sedang mengedit item yang dihapus
    }

    public function resetForm()
    {
        $this->reset(['name', 'points', 'selected_task_id', 'isEditing']);
    }

    /**
     * Render komponen
     */
    // notifikasi pengingat
    public function triggerReminders()
    {
        try {
            // 1. panggil command artisan dari kode
            Artisan::call('app:send-checklist-reminders');

            // 2. pesan sukses
            session()->flash('message', 'Notifikasi pengingat telah dikirim ke peserta yang belum ceklis.');

        } catch (\Exception $e) {
            // 3. pesan eror
            session()->flash('error', 'Gagal mengirim notifikasi: ' . $e->getMessage());
        }
    }

    // render
    public function render()
    {
        $totalParticipants = User::where('role', 'participant')->count();
        $totalTasks = Task::count();
        $totalCheckinsToday = Checkin::where('date', Carbon::today()->toDateString())
                             ->distinct('user_id')
                             ->count('user_id');
        $totalNotCheckinsToday = $totalParticipants - $totalCheckinsToday;
        // logika statistik
        
        $tasks = Task::orderBy('created_at', 'desc')->paginate(10);
        
        return view('livewire.admin.task-manager', [
            'tasks' => $tasks,
            
            // statistik ke view
            'totalParticipants' => $totalParticipants,
            'totalTasks' => $totalTasks,
            'totalCheckinsToday' => $totalCheckinsToday,
            'totalNotCheckinsToday' => $totalNotCheckinsToday   
            
        ])->layout('layouts.app'); // layout default laravel
    }

    // create
    public function create()
    {
        $this->resetForm();
    }
}
