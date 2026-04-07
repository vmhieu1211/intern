<?php

namespace App\Livewire;

use Livewire\Component;

class FooterDetail extends Component
{
    public function render()
    {
        // $shareSettings đã được share global từ AppServiceProvider
        return view('livewire.footer-detail');
    }
}
