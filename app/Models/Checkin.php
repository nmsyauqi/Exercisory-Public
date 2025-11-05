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

    /**
     * Mendapatkan user pemilik checkin.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mendapatkan tugas dari checkin.
     */
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}