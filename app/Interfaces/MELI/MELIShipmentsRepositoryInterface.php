<?php

namespace App\Interfaces\MELI;


interface MELIShipmentsRepositoryInterface
{

    public function getItemsByShipment($shipment_id);
}
