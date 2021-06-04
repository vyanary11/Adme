<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
    public $modal;
    public $title;
    public $size;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($modal, $title, $size="lg")
    {
        $this->modal = $modal;
        $this->title = $title;
        $this->size = $size;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.modal');
    }
}
