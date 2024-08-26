<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Item extends Component
{
    public $item_id;

    /**
     * Create a new component instance.
     */
    public function __construct($item_id)
    {
        $this->item_id = $item_id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.item', ['item_id' => $this->item_id]);
    }
}
