<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class FileUpload extends Component
{
    use WithFileUploads;

    public $photo;
    public $filename;

    public function upload()
    {
        $this->validate([
            'photo' => 'image|max:2048',  // 2MBまで
        ]);
        $filename = Str::random(20) . '.' . $this->photo->getClientOriginalExtension();
        $this->photo->storeAs('photos', $filename, 'public');
        $this->filename = $filename;
        session()->flash('message', '画像をアップロードしました: ' . $filename);
    }
    public function render()
    {
        return view('livewire.file-upload', ['filename' => $this->filename]);
    }
}
