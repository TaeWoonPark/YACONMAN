<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'work_time', // 作業時間
        'notes',     // 作業メモ
        'completed_at',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
