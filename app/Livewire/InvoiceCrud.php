<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Invoice;
use App\Models\Task;
use App\Models\Client;

class InvoiceCrud extends Component
{
    public $invoices, $invoice_id;
    public $task_id, $client_id, $amount, $issued_at, $status, $remarks;
    public $updateMode = false;

    public function render()
    {
        $this->invoices = Invoice::with('task', 'client')->get();
        return view('livewire.invoice-crud', [
            'tasks' => Task::all(),
            'clients' => Client::all(),
        ]);
    }

    public function resetInput()
    {
        $this->task_id = '';
        $this->client_id = '';
        $this->amount = '';
        $this->issued_at = '';
        $this->status = '';
        $this->remarks = '';
    }

    public function store()
    {
        $this->validate([
            'task_id' => 'required',
            'client_id' => 'required',
            'amount' => 'required|numeric',
            'issued_at' => 'required|date',
        ]);

        Invoice::create([
            'task_id' => $this->task_id,
            'client_id' => $this->client_id,
            'amount' => $this->amount,
            'issued_at' => $this->issued_at,
            'status' => $this->status,
            'remarks' => $this->remarks,
        ]);
        session()->flash('message', '請求書を登録しました。');
        $this->resetInput();
    }

    public function edit($id)
    {
        $invoice = Invoice::findOrFail($id);
        $this->invoice_id = $id;
        $this->task_id = $invoice->task_id;
        $this->client_id = $invoice->client_id;
        $this->amount = $invoice->amount;
        $this->issued_at = $invoice->issued_at;
        $this->status = $invoice->status;
        $this->remarks = $invoice->remarks;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'task_id' => 'required',
            'client_id' => 'required',
            'amount' => 'required|numeric',
            'issued_at' => 'required|date',
        ]);

        if ($this->invoice_id) {
            $invoice = Invoice::find($this->invoice_id);
            $invoice->update([
                'task_id' => $this->task_id,
                'client_id' => $this->client_id,
                'amount' => $this->amount,
                'issued_at' => $this->issued_at,
                'status' => $this->status,
                'remarks' => $this->remarks,
            ]);
            session()->flash('message', '請求書を更新しました。');
            $this->resetInput();
            $this->updateMode = false;
        }
    }

    public function delete($id)
    {
        if ($id) {
            Invoice::find($id)->delete();
            session()->flash('message', '請求書を削除しました。');
        }
    }
}
