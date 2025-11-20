<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    public string $action;
    public string $method;
    public string $enctype;
    public string $class;
    public string $contentClass;

    /**
     * Create a new component instance.
     */
    public function __construct(string $action, string $method, string $class = "", string $contentClass = "", string $enctype = "")
    {
        $this->action = $action;
        $this->method = $method;
        $this->enctype = $enctype;
        $this->class = $class;
        $this->contentClass = $contentClass;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form');
    }
}
