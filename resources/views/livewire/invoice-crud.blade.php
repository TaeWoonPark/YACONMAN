<div>
    <h2>請求書一覧</h2>
    @if (session()->has('message'))
        <div>{{ session('message') }}</div>
    @endif
    <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}">
        <select wire:model="task_id" required>
            <option value="">タスク選択</option>
            @foreach ($tasks as $task)
                <option value="{{ $task->id }}">{{ $task->title }}</option>
            @endforeach
        </select>
        <select wire:model="client_id" required>
            <option value="">委託元選択</option>
            @foreach ($clients as $client)
                <option value="{{ $client->id }}">{{ $client->name }}</option>
            @endforeach
        </select>
        <input type="number" wire:model="amount" placeholder="金額" required>
        <input type="date" wire:model="issued_at" placeholder="発行日" required>
        <select wire:model="status">
            <option value="">状態</option>
            <option value="未請求">未請求</option>
            <option value="請求済">請求済</option>
            <option value="入金済">入金済</option>
        </select>
        <input type="text" wire:model="remarks" placeholder="備考欄">
        <button type="submit">{{ $updateMode ? '更新' : '登録' }}</button>
        @if ($updateMode)
            <button type="button" wire:click="resetInput">キャンセル</button>
        @endif
    </form>
    <table border="1" cellpadding="4">
        <thead>
            <tr>
                <th>タスク</th>
                <th>委託元</th>
                <th>金額</th>
                <th>発行日</th>
                <th>状態</th>
                <th>備考</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->task->title ?? '-' }}</td>
                    <td>{{ $invoice->client->name ?? '-' }}</td>
                    <td>{{ $invoice->amount }}</td>
                    <td>{{ $invoice->issued_at }}</td>
                    <td>{{ $invoice->status }}</td>
                    <td>{{ $invoice->remarks }}</td>
                    <td>
                        <button wire:click="edit({{ $invoice->id }})">編集</button>
                        <button wire:click="delete({{ $invoice->id }})"
                            onclick="return confirm('本当に削除しますか？')">削除</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
