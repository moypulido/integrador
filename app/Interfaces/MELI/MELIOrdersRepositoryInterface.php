<?php

namespace App\Interfaces\MELI;

interface MELIOrdersRepositoryInterface
{
    public function getOrders($seler_id,  $filters = [], $sort = null,  $limit = 10, $offset = 0);

    public function getOrder($order_id);
}
