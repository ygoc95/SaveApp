<?php

namespace App\View\Components;

use Illuminate\View\Component;

class type_list extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $type;
    public function __construct($type)
    {
        $this->type=$type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.type_list');
    }
}
