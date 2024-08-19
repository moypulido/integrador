<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Interfaces\MELI\MELIOrdersRepositoryInterface;
use App\Interfaces\MELI\MELIShipmentsRepositoryInterface;

class LabelController extends Controller
{
    protected $MELIordersRepository;
    protected $MELIshipmentsRepository;

    public function __construct(
        MELIOrdersRepositoryInterface $MELIordersRepository,
        MELIShipmentsRepositoryInterface $MELIshipmentsRepository
    ) {
        $this->MELIordersRepository = $MELIordersRepository;
        $this->MELIshipmentsRepository = $MELIshipmentsRepository;
    }

    public function printLabel($order_id)
    {
        $order = $this->MELIordersRepository->getOrder($order_id);
        $shipping_id = $order->shipping->id;
    }
}
