<h2>タスク一覧帳票</h2>
<table border="1" cellspacing="0" cellpadding="4">
    <thead>
        <tr>
            <th>ID</th>
            <th>タイトル</th>
            <th>顧客</th>
            <th>作業所</th>
            <th>状態</th>
            <th>納期</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tasks as $task)
            <tr>
                <td>{{ $task->id }}</td>
                <td>{{ $task->title }}</td>
                <td>{{ $task->client->name ?? '-' }}</td>
                <td>{{ $task->workshop->name ?? '-' }}</td>
                <td>{{ $task->status }}</td>
                <td>{{ $task->due_date }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
