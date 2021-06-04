<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DataTable extends Component
{
    public $ajaxUrl;
    public $columns;
    public $checkbox;
    public $searching;
    public $lengthMenu;
    public $actions;
    public $action;
    public $order;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($ajaxUrl, $columns, $checkbox=true, $actions=[], $searching=true, $lengthMenu=true, $action=true, $order=[0,'desc'])
    {
        $this->ajaxUrl = $ajaxUrl;
        $this->columns = $columns;
        $this->checkbox = $checkbox;
        $this->actions = $actions;
        $this->searching = $searching;
        $this->lengthMenu = $lengthMenu;
        $this->action=$action;
        $this->order = $order;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.data-table');
    }
}
