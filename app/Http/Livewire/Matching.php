<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Task;
use App\Models\Workshop;

class Matching extends Component
{
    public $keyword = '';
    public $availableDate = '';
    public $tasks;
    public $workshops;

    public function search()
    {
        $this->tasks = Task::where('title', 'like', '%' . $this->keyword . '%')->get();
        $this->workshops = Workshop::where('name', 'like', '%' . $this->keyword . '%')->get();
    }

    public function mount()
    {
        $this->tasks = Task::all();
        $this->workshops = Workshop::all();
    }

    public function render()
    {
        return view('livewire.matching');
    }
}
