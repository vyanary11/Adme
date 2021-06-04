<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormModal extends Component
{
    public $route;
    public $name;
    public $title;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $route, $title)
    {
        $this->name = $name;
        $this->route = $route;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.form-modal');
    }
}
