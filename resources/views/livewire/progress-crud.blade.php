<div>
    <h2>進捗一覧</h2>
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
        <select wire:model="status" required>
            <option value="">ステータス選択</option>
            <option value="未着手">未着手</option>
            <option value="進行中">進行中</option>
            <option value="完了">完了</option>
        </select>
        <textarea wire:model="report" placeholder="作業報告"></textarea>
        <input type="number" wire:model="work_time" placeholder="作業時間(分)">
        <input type="text" wire:model="photo" placeholder="写真URL または ファイル名">
        <input type="date" wire:model="worked_at" placeholder="作業日">
        <button type="submit">{{ $updateMode ? '更新' : '登録' }}</button>
        @if ($updateMode)
            <button type="button" wire:click="resetInput">キャンセル</button>
        @endif
    </form>

    <table border="1" cellpadding="4">
        <thead>
            <tr>
                <th>タスク</th>
                <th>状態</th>
                <th>報告</th>
                <th>時間</th>
                <th>写真</th>
                <th>作業日</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($progresses as $progress)
                <tr>
                    <td>{{ $progress->task->title ?? '-' }}</td>
                    <td>{{ $progress->status }}</td>
                    <td>{{ $progress->report }}</td>
                    <td>{{ $progress->work_time }}</td>
                    <td>{{ $progress->photo }}</td>
                    <td>{{ $progress->worked_at }}</td>
                    <td>
                        <button wire:click="edit({{ $progress->id }})">編集</button>
                        <button wire:click="delete({{ $progress->id }})"
                            onclick="return confirm('本当に削除しますか？')">削除</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
