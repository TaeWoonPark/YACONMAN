<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Task;
use App\Models\Progress;
use App\Models\Invoice;
use Carbon\Carbon;

class Dashboard extends Component
{
    public $taskCount;
    public $inProgressCount;
    public $completeCount;
    public $invoiceTotalThisMonth;

    public function mount()
    {
        $this->taskCount = Task::count();
        $this->inProgressCount = Task::where('status', '進行中')->count();
        $this->completeCount = Task::where('status', '完了')->count();
        $this->invoiceTotalThisMonth = Invoice::whereMonth('issued_at', Carbon::now()->month)
            ->sum('amount');
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
