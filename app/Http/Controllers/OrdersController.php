<?php

namespace App\Http\Controllers;

use App\Interfaces\MELI\MELIOrdersRepositoryInterface;
use Illuminate\Http\Request;
use App\Interfaces\UserRepositoryInterface;

class OrdersController extends Controller
{
    protected $ordersRepository;
    protected $userRepository;

    public function __construct(MELIOrdersRepositoryInterface $ordersRepository, UserRepositoryInterface $userRepository)
    {
        $this->ordersRepository = $ordersRepository;
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $order_id = $request->query('order_id');

        if ($order_id) {
            $order = $this->ordersRepository->getOrder($order_id);
            $orders = collect([$order]);
            return view('orders.index', compact('orders'));
        }

        $user_meli_id = $this->userRepository->getAuthenticatedUser()->id_meli;
        $orders = $this->ordersRepository->getOrders($user_meli_id)->results;

        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $orders = $this->ordersRepository->getOrder($id);
        return view('orders.index', compact('orders'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function edit($id)
    {
        //
    }
}
