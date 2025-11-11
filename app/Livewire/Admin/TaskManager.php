<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Task;
use App\Models\User;
use App\Models\Checkin;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth; 
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class TaskManager extends Component
{
    use WithPagination;

    public function boot()
    {
        // 1. Ambil data TERBARU dari database
        $user = User::find(Auth::id());

        // 2. Cek apakah dia MASIH seorang admin DAN MASIH aktif?
        if (strtolower($user->role) !== 'admin' || $user->trashed()) {
            
            // 3. Jika tidak, hentikan aksi ini SEKARANG JUGA.
            abort(403, 'Akses Ditolak: Peran Anda telah diubah atau dinonaktifkan.');
        }
    }

    // properti form
    public $name;
    public $points;

    // state editing
    public $selected_task_id;
    public $isEditing = false;

    // rules validasi
    protected $rules = [
        'name' => 'required|string|min:3|max:255',
        'points' => 'required|integer|min:1',
    ];

    // simpan atau update tugas
    public function save()
    {
        $this->validate();

        Task::updateOrCreate(
            ['id' => $this->selected_task_id],
            [
                'name' => $this->name,
                'points' => $this->points
            ]
        );

        session()->flash('message', $this->isEditing ? 'Tugas berhasil diperbarui.' : 'Tugas baru berhasil ditambahkan.');
        $this->resetForm();
    }

    // mode edit
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
            session()->flash('error', 'Gagal menghapus tugas.');
        }
        $this->resetForm();
    }

    // reset input form
    public function resetForm()
    {
        $this->reset(['name', 'points', 'selected_task_id', 'isEditing']);
    }

    // kirim notifikasi manual
    public function triggerReminders()
    {
        try {
            Artisan::call('app:send-checklist-reminders');
            session()->flash('message', 'Notifikasi pengingat telah dikirim.');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal mengirim notifikasi: ' . $e->getMessage());
        }
    }

    public function toggleJokesExe()
{
    $flagFile = 'jokes.exe.enabled';

    if (Storage::disk('local')->exists($flagFile)) {
        // Jika file ada (fitur aktif), hapus file (nonaktifkan)
        Storage::disk('local')->delete($flagFile);
        session()->flash('message', 'Fitur Jokes.exe [DINONAKTIFKAN].');
    } else {
        // Jika file tidak ada (fitur nonaktif), buat file (aktifkan)
        Storage::disk('local')->put($flagFile, 'true');
        session()->flash('message', 'Fitur Jokes.exe [DIAKTIFKAN].');
    }
}

    public function render()
    {
        // satpam render: cek akses admin setiap refresh
        $currentUser = User::find(Auth::id());
        if (strtolower($currentUser->role) !== 'admin' || $currentUser->trashed()) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Akses dicabut.');
        }

        // hitung statistik
        $totalParticipants = User::where('role', 'participant')->count();
        $totalTasks = Task::count();
        
        // hitung peserta unik yang checkin hari ini
        $totalCheckinsToday = Checkin::where('date', Carbon::today()->toDateString())
                                     ->join('users', 'checkins.user_id', '=', 'users.id')
                                     ->where('users.role', 'participant')
                                     ->distinct('checkins.user_id')
                                     ->count('checkins.user_id');
                                     
        // hitung yang belum checkin
        $totalNotCheckinsToday = $totalParticipants - $totalCheckinsToday;
        
        // ambil data tugas dengan paginasi
        $tasks = Task::orderBy('created_at', 'desc')->paginate(10);
        
        return view('livewire.admin.task-manager', [
            'tasks' => $tasks,
            'totalParticipants' => $totalParticipants,
            'totalTasks' => $totalTasks,
            'totalCheckinsToday' => $totalCheckinsToday,
            'totalNotCheckinsToday' => $totalNotCheckinsToday,
            'today' => Carbon::today() // kirim tanggal hari ini ke view
        ])->layout('layouts.app');
    }
}