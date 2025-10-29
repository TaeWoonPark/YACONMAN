<div>
    <h2>マッチング検索</h2>
    <form wire:submit.prevent="search">
        <input type="text" wire:model="keyword" placeholder="案件・作業所キーワード">
        <button type="submit">検索</button>
    </form>
    <h3>案件一覧</h3>
    <table border="1" cellpadding="4">
        <tr>
            <th>タイトル</th>
            <th>顧客</th>
            <th>作業所</th>
            <th>ステータス</th>
            <th>納期</th>
        </tr>
        @foreach ($tasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>{{ $task->client->name ?? '-' }}</td>
                <td>{{ $task->workshop->name ?? '-' }}</td>
                <td>{{ $task->status }}</td>
                <td>{{ $task->due_date }}</td>
            </tr>
        @endforeach
    </table>
    <h3>作業所一覧</h3>
    <table border="1" cellpadding="4">
        <tr>
            <th>作業所名</th>
            <th>種別</th>
            <th>住所</th>
            <th>電話番号</th>
        </tr>
        @foreach ($workshops as $workshop)
            <tr>
                <td>{{ $workshop->name }}</td>
                <td>{{ $workshop->type }}</td>
                <td>{{ $workshop->address }}</td>
                <td>{{ $workshop->phone }}</td>
            </tr>
        @endforeach
    </table>
</div>
