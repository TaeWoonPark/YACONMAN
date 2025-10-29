<div>
    <h3>タスク帳票PDF出力</h3>
    <form method="POST" action="{{ route('livewire.report-pdf.export') }}">
        @csrf
        <button type="submit">PDFダウンロード</button>
    </form>
    <p style="font-size:90%; color:gray;">全タスクの帳票一覧PDFが生成されます（DomPDF利用）。会議・報告書用など印刷にも便利です。</p>
</div>
