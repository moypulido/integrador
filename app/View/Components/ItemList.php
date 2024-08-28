<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Interfaces\MELI\MELIItemsRepositoryInterface;

class ItemList extends Component
{
    public $item;

    /**
     * Create a new component instance.
     *
     * @param mixed $item
     */
    public function __construct($item)
    {
        $MELIItemsRepository = app(MELIItemsRepositoryInterface::class);
        $this->item = $MELIItemsRepository->getItem($item);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.item-list');
    }
}
