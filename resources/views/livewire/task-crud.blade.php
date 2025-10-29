<div>
    <h2>タスク一覧</h2>

    @if (session()->has('message'))
        <div>{{ session('message') }}</div>
    @endif

    <!-- 新規 or 編集フォーム -->
    <form>
        <input type="text" wire:model="title" placeholder="タイトル" required>
        <textarea wire:model="description" placeholder="説明"></textarea>

        <select wire:model="client_id" required>
            <option value="">委託元を選択</option>
            @foreach ($clients as $client)
                <option value="{{ $client->id }}">{{ $client->name }}</option>
            @endforeach
        </select>

        <select wire:model="workshop_id" required>
            <option value="">作業所を選択</option>
            @foreach ($workshops as $workshop)
                <option value="{{ $workshop->id }}">{{ $workshop->name }}</option>
            @endforeach
        </select>

        <select wire:model="status">
            <option value="">ステータス選択</option>
            <option value="未着手">未着手</option>
            <option value="進行中">進行中</option>
            <option value="完了">完了</option>
        </select>

        <input type="date" wire:model="due_date" placeholder="納期">

        @if ($updateMode)
            <button type="button" wire:click="update">更新</button>
            <button type="button" wire:click="resetInput">キャンセル</button>
        @else
            <button type="button" wire:click="store">登録</button>
        @endif
    </form>

    <table border="1" cellpadding="4">
        <thead>
            <tr>
                <th>タイトル</th>
                <th>説明</th>
                <th>委託元</th>
                <th>作業所</th>
                <th>ステータス</th>
                <th>納期</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->client->name ?? '-' }}</td>
                    <td>{{ $task->workshop->name ?? '-' }}</td>
                    <td>{{ $task->status }}</td>
                    <td>{{ $task->due_date }}</td>
                    <td>
                        <button wire:click="edit({{ $task->id }})">編集</button>
                        <button wire:click="delete({{ $task->id }})"
                            onclick="return confirm('本当に削除しますか？')">削除</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
