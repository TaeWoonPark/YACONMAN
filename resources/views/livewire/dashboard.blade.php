<div>
    <h2>管理Dashboard</h2>
    <ul style="list-style:none; padding:0;">
        <li><strong>全タスク数：</strong> {{ $taskCount }} 件</li>
        <li><strong>進行中タスク：</strong> {{ $inProgressCount }} 件</li>
        <li><strong>完了タスク：</strong> {{ $completeCount }} 件</li>
        <li><strong>今月の請求合計：</strong> {{ number_format($invoiceTotalThisMonth) }} 円</li>
    </ul>
    <p>▼ 次の機能：<br>
        ・CSV/Excelダウンロードや、グラフ表示、各機能のショートカットも順次追加可能です。</p>
</div>
