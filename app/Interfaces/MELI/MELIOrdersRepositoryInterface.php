<?php

namespace App\Interfaces\MELI;

interface MELIOrdersRepositoryInterface
{
    public function getOrders($seler_id,  $filters = [], $sort = null);

    public function getOrder($order_id);
}
