<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'amount',
        'issued_at',
        'paid_at',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
