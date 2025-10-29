<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Task;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportPdf extends Component
{
    public $tasks;
    public function mount()
    {
        $this->tasks = Task::with(['client', 'workshop'])->get();
    }

    public function exportTaskListPdf()
    {
        $tasks = Task::with(['client', 'workshop'])->get();
        $pdf = Pdf::loadView('exports.task-list', compact('tasks'));
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'task_list_' . now()->format('Ymd_His') . '.pdf');
    }
    public function render()
    {
        return view('livewire.report-pdf', ['tasks' => $this->tasks]);
    }
}
