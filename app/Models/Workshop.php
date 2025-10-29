<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type', // A型/B型
        'address',
        'phone',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
