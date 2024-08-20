<?php

namespace App\Interfaces\MELI;


interface MELIShipmentsRepositoryInterface
{
    public function getShipmet($shipment_id);

    public function getItemsByShipment($shipment_id);

    public function getShippingLabels($shipment_id);
}
