<?php

namespace App\Livewire;

use Livewire\Component;


class HandleMissingPageController extends Component
{

    public function render()
    {
        return view('livewire.404-code')->layout('layouts.guest');
    }
}
