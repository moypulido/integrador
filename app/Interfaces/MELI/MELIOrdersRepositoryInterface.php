<?php

namespace App\Interfaces\MELI;

interface MELIOrdersRepositoryInterface
{
    public function getOrders($seler_id);

    public function getOrder($order_id);
}
