<?php

namespace App\Livewire;

use Livewire\Component;

class Counter extends Component
{

    public $count = 10;

    public function increment()
    {
        $this->count++;
    }

    // not needed because Laravel checks for a Counter blade by default
    public function render()
    {
        return view('livewire.counter');
    }
}
