<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class inputDate extends Component
{
    public $id, $name;
    /**
     * Create a new component instance.
     */
    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-date');
    }
}
