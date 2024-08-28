<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Order extends Component
{
    public $order;

    /**
     * Create a new component instance.
     *
     * @param string $item_id
     */
    public function __construct($order)
    {
        $order->date_created = formatDate($order->date_created);
        $this->order = $order;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.order');
    }
}
