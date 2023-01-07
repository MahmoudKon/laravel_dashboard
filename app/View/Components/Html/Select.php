<?php

namespace App\View\Components\Html;

use Illuminate\View\Component;

class Select extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public string $name, public array|object $list, public string $required = '', public string $label = '', public int|array|null $selected = [])
    {
        $this->selected = is_int($this->selected) ? [$this->selected] : $this->selected;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.html.select');
    }
}
