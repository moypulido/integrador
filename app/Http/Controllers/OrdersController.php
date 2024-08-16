<?php

namespace App\Http\Controllers;

use App\Interfaces\MELI\MELIOrdersRepositoryInterface;
use Illuminate\Http\Request;
use App\Interfaces\UserRepositoryInterface;
use Carbon\Carbon;

class OrdersController extends Controller
{
    protected $MELIordersRepository;
    protected $userRepository;

    public function __construct(MELIOrdersRepositoryInterface $MELIordersRepository, UserRepositoryInterface $userRepository)
    {
        $this->MELIordersRepository = $MELIordersRepository;
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);
        $offset = ($page - 1) * $limit;
        $user_meli_id = $this->userRepository->getAuthenticatedUser()->id_meli;

        $filters = [
            'order.date_created.from' => Carbon::now()->subDays(60)->toIso8601String(),
            'order.date_created.to' =>  Carbon::now()->toIso8601String(),
        ];

        $sort = 'date_desc';

        $response = $this->MELIordersRepository->getOrders($user_meli_id, $filters, $sort, $limit, $offset);
        $orders = collect($response->results);
        $total = $response->paging->total;

        return view('orders.index', compact('orders', 'total', 'page', 'limit'));
    }

    public function show(request $request, $order_id)
    {
        dd($request, $order_id);
        return view('orders.show', compact('orders'));
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
    public function search(Request $request)
    {
        $orderId = $request->input('order_id');
        
        dd($request, $orderId);

        // if ($orderId) {
        //     return redirect()->route('orders.show', ['order' => $orderId]);
        // }
    
        // return redirect()->route('orders.index')->with('error', 'Order ID not found');
    }
}
