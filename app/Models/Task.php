<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'workshop_id',
        'title',
        'description',
        'status', // 未着手/進行中/完了
        'due_date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }

    public function progresses()
    {
        return $this->hasMany(Progress::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}
