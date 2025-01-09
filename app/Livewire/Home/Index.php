<?php

namespace App\Livewire\Home;

use Livewire\Component;

class Index extends Component
{
    #[Title('QR Scanner App - PT. KPA')]
    public function render()
    {
        return view('livewire.home.index');
    }
}
