<?php

namespace App\Livewire;

use Livewire\Component;
use App\Traits\LinkShortner;
use Livewire\Attributes\Validate;

class LinkShortnerForm extends Component
{
    use LinkShortner;

    #[Validate('required|url', as: 'Original link')]
    public string|null $originalLink = null;
    #[Validate('required|string|max:10|unique:link_redirects,redirect_to', as: 'Short value')]
    public string|null $redirectString = null;

    public function render()
    {
        return view('livewire.link-shortner-form')->layout('layouts.guest');
    }

    public function save()
    {
        $this->createShortLink(null, $this->originalLink, $this->redirectString);
        $this->alert('success', 'Your link was successfully created.');
    }
}
