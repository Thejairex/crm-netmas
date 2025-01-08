<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputTextarea extends Component
{
    public $id;
    public $name;
    public $rows;
    public $cols;

    public function __construct($id, $name, $rows = 4, $cols = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->rows = $rows;
        $this->cols = $cols;
    }

    public function render()
    {
        return view('components.input-textarea');
    }
}
