<?php

namespace App\Http\Controllers;

use App\Interfaces\MELI\MELIOrdersRepositoryInterface;
use Illuminate\Http\Request;
use App\Interfaces\UserRepositoryInterface;
use Carbon\Carbon;

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
        $page = $request->query('page', 1);
        $limit = 10;
        $offset = ($page - 1) * $limit;
        $total = 0;

        // if ($request->query('order_id')) {
        //     $order_id = $request->query('order_id');

        //     if (!is_numeric($order_id)) {
        //         return redirect()->route('orders.index')->with('error', 'Order ID must be a number');
        //     }
        //     $order = $this->ordersRepository->getOrder($order_id);
        //     if ($order) {
        //         dd($order);
        //         $orders = collect([$order]);
        //         $total = 1;
        //         return view('orders.index', compact('orders', 'total', 'page', 'limit'));
        //     } else {
        //         return redirect()->route('orders.index')->with('error', 'Order not found');
        //     }
        // }

        $user_meli_id = $this->userRepository->getAuthenticatedUser()->id_meli;

        $filters = [
            'order.date_created.from' => Carbon::now()->subDays(60)->toIso8601String(),
            'order.date_created.to' =>  Carbon::now()->toIso8601String(),
        ];

        $sort = 'date_desc';

        $response = $this->ordersRepository->getOrders($user_meli_id, $filters, $sort, $limit, $offset);
        $orders = collect($response->results);
        $total = $response->paging->total;

        return view('orders.index', compact('orders', 'total', 'page', 'limit'));
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
