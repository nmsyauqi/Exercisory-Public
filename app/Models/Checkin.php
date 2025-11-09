<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkin extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'task_id',
        'date',
        'checked_at',
    ];

    // pemilik checkin
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // tugas terkait checkin
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}