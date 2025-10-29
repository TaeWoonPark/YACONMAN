<div>
    <h3>写真アップロード</h3>
    @if (session()->has('message'))
        <div>{{ session('message') }}</div>
    @endif
    <form wire:submit.prevent="upload">
        <input type="file" wire:model="photo" accept="image/*">
        <button type="submit">アップロード</button>
    </form>
    @if ($filename)
        <p>アップロード済みファイル: {{ $filename }}</p>
        <img src="{{ asset('storage/photos/' . $filename) }}" style="max-width:200px;">
    @endif
</div>
