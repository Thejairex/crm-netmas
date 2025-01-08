<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputFile extends Component
{
    public $id;
    public $name;
    public $accept;
    public function __construct($id, $name, $accept)
    {
        $this->id = $id;
        $this->name = $name;
        $this->accept = $accept;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-file');
    }
}
