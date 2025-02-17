<?php

namespace App\View\Components;

use App\Weather;
use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Meteo extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(private Weather $weather)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.meteo', [
            'isSunny' => $this->weather->isSunnyTommorow()
        ]);
    }
}
