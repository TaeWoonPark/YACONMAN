<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Task;
use App\Models\Client;
use App\Models\Workshop;

class TaskCrud extends Component
{
    public $task_id;
    public $title, $description, $client_id, $workshop_id, $status, $due_date;
    public $updateMode = false;

    public function render()
    {
        // Livewire では public プロパティは Blade に自動で渡される
        $tasks = Task::with('client', 'workshop')->get();
        $clients = Client::all();
        $workshops = Workshop::all();

        return view('livewire.task-crud', compact('tasks', 'clients', 'workshops'));
    }

    public function resetInput()
    {
        $this->title = '';
        $this->description = '';
        $this->client_id = '';
        $this->workshop_id = '';
        $this->status = '';
        $this->due_date = '';
        $this->updateMode = false;
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'client_id' => 'required',
            'workshop_id' => 'required',
        ]);

        Task::create([
            'title' => $this->title,
            'description' => $this->description,
            'client_id' => $this->client_id,
            'workshop_id' => $this->workshop_id,
            'status' => $this->status,
            'due_date' => $this->due_date,
        ]);

        session()->flash('message', 'タスクを登録しました。');
        $this->resetInput();
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $this->task_id = $id;
        $this->title = $task->title;
        $this->description = $task->description;
        $this->client_id = $task->client_id;
        $this->workshop_id = $task->workshop_id;
        $this->status = $task->status;
        $this->due_date = $task->due_date;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'title' => 'required',
            'client_id' => 'required',
            'workshop_id' => 'required',
        ]);

        if ($this->task_id) {
            $task = Task::find($this->task_id);
            $task->update([
                'title' => $this->title,
                'description' => $this->description,
                'client_id' => $this->client_id,
                'workshop_id' => $this->workshop_id,
                'status' => $this->status,
                'due_date' => $this->due_date,
            ]);
            session()->flash('message', 'タスクを更新しました。');
            $this->resetInput();
        }
    }

    public function delete($id)
    {
        Task::find($id)->delete();
        session()->flash('message', 'タスクを削除しました。');
    }
}
