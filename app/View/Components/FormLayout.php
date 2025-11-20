<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormLayout extends Component
{
    public string $action;
    public string $method;
    public string $enctype;

    /**
     * Create a new component instance.
     */
    public function __construct(string $action, string $method, string $enctype = "")
    {
        $this->action = $action;
        $this->method = $method;
        $this->enctype = $enctype;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-layout');
    }
}
