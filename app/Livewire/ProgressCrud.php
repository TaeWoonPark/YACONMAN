<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Progress;
use App\Models\Task;

class ProgressCrud extends Component
{
    public $progresses, $progress_id;
    public $task_id, $status, $report, $work_time, $photo, $worked_at;
    public $updateMode = false;

    public function render()
    {
        $this->progresses = Progress::with('task')->get();
        return view('livewire.progress-crud', [
            'tasks' => Task::all(),
        ]);
    }

    public function resetInput()
    {
        $this->task_id = '';
        $this->status = '';
        $this->report = '';
        $this->work_time = '';
        $this->photo = '';
        $this->worked_at = '';
    }

    public function store()
    {
        $this->validate([
            'task_id' => 'required',
            'status' => 'required',
            'worked_at' => 'required|date',
        ]);

        Progress::create([
            'task_id' => $this->task_id,
            'status' => $this->status,
            'report' => $this->report,
            'work_time' => $this->work_time,
            'photo' => $this->photo,
            'worked_at' => $this->worked_at,
        ]);

        session()->flash('message', '進捗を登録しました。');
        $this->resetInput();
    }

    public function edit($id)
    {
        $progress = Progress::findOrFail($id);
        $this->progress_id = $id;
        $this->task_id = $progress->task_id;
        $this->status = $progress->status;
        $this->report = $progress->report;
        $this->work_time = $progress->work_time;
        $this->photo = $progress->photo;
        $this->worked_at = $progress->worked_at;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'task_id' => 'required',
            'status' => 'required',
            'worked_at' => 'required|date',
        ]);

        if ($this->progress_id) {
            $progress = Progress::find($this->progress_id);
            $progress->update([
                'task_id' => $this->task_id,
                'status' => $this->status,
                'report' => $this->report,
                'work_time' => $this->work_time,
                'photo' => $this->photo,
                'worked_at' => $this->worked_at,
            ]);
            session()->flash('message', '進捗を更新しました。');
            $this->resetInput();
            $this->updateMode = false;
        }
    }

    public function delete($id)
    {
        if ($id) {
            Progress::find($id)->delete();
            session()->flash('message', '進捗を削除しました。');
        }
    }
}
