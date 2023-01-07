<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LinkTag extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public string $route = '#', public string $text = 'List', public string $title = 'List',
                                public string $classess = '', public string $icon = '', public bool $visible = true)
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
        return view('components.link-tag');
    }
}
