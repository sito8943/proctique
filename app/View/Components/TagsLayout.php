<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TagsLayout extends Component
{
    public iterable $tags = [];

    /**
     * Create a new component instance.
     */
    public function __construct(iterable $tags = [])
    {
        $this->tags = $tags;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tags-layout');
    }
}
