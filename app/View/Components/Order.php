<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Carbon;

class Order extends Component
{
    public $order;

    /**
     * Create a new component instance.
     */
    public function __construct($order)
    {
        // dd($order->date_created);
        $order->date_created = Carbon::parse($order->date_created)
            ->setTimezone('Etc/GMT+6')
            ->translatedFormat('d M Y H:i') . ' hs';
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
