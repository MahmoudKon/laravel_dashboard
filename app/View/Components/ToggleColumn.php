<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ToggleColumn extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public int $id, public string $column = 'active', public bool $value)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.toggle-column');
    }
}
