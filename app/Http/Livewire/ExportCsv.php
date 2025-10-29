<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Task;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportCsv extends Component
{
    public function export()
    {
        $fileName = 'tasks_export_' . now()->format('Ymd_His') . '.csv';

        $response = new StreamedResponse(function () {
            $handle = fopen('php://output', 'w');
            // ヘッダ
            fputcsv(
                $handle,
                [
                    'ID',
                    'タイトル',
                    '説明',
                    '顧客',
                    '作業所',
                    '進捗',
                    '納期',
                    '登録日'
                ]
            );
            foreach (Task::with(['client', 'workshop'])->get() as $task) {
                fputcsv($handle, [
                    $task->id,
                    $task->title,
                    $task->description,
                    $task->client->name ?? '-',
                    $task->workshop->name ?? '-',
                    $task->status,
                    $task->due_date,
                    $task->created_at
                ]);
            }
            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $fileName . '"');
        return $response;
    }

    public function render()
    {
        return view('livewire.export-csv');
    }
}
