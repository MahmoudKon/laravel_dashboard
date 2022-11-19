<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PreviewImage extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public string|null $image = null, public string|null $alt = null,
                                public string|null $title = null, public string $width = '100px',
                                public string $classess = '')
    {
        $this->image = $this->image && file_exists($this->image) ? asset($this->image) : asset('app-assets/backend/images/portfolio/portfolio-1.jpg');
        $this->alt = $this->alt ?? trans('title.avatar');
        $this->title = $this->title ?? trans('title.preview-image');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.preview-image');
    }
}
