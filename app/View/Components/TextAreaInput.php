<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextAreaInput extends Component
{
    public string $name;
    public string $label;
    public string $value = "";
    public string $placeholder = "";
    public string $id = "";

    public string $rows = "";

    /**
     * Create a new component instance.
     */
    public function __construct(string $name, string $label, string $id = "", string $rows = "2", string $placeholder = "", string $value = "")
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->id = $id;
        $this->rows = $rows;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.text-area-input');
    }
}
