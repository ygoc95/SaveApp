<?php

namespace App\View\Components;

use Illuminate\View\Component;

class currency_list extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $currency;

    public function __construct($currency)
    {
        $this->currency=$currency;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.currency_list');
    }
}
