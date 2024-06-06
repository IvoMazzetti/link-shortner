<?php

namespace App\Livewire;

use Livewire\Component;


class HandleMissingPageController extends Component
{

     /**
     * Renders the 404 error page with the specified layout.
     *
     * @return \Illuminate\Contracts\View\View The rendered view.
     */
    public function render()
    {
        return view('livewire.404-code')->layout('layouts.guest');
    }
}
