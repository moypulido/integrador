<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Item extends Component
{
    public $item_id;

    /**
     * Create a new component instance.
     *
     * @param string $item_id
     */
    public function __construct(string $item_id)
    {
        $this->item_id = $item_id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|string
    {
        return view('components.item', ['item_id' => $this->item_id]);
    }
}
