<?php

namespace App\Http\Controllers;

use App\Interfaces\MELI\MELIOrdersRepositoryInterface;
use App\Interfaces\MELI\MELIPacksRepositoryInterface;
use App\Interfaces\MELI\MELIShipmentsRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrdersController extends Controller
{
    protected $MELIordersRepository;
    protected $MELIPacksRepository;
    protected $MELIShipmentsRepository;
    protected $userRepository;

    public function __construct(
        MELIOrdersRepositoryInterface $MELIordersRepository,
        MELIPacksRepositoryInterface $MELIPacksRepository,
        MELIShipmentsRepositoryInterface $MELIShipmentsRepository,
        UserRepositoryInterface $userRepository,
    ) {
        $this->MELIordersRepository = $MELIordersRepository;
        $this->MELIPacksRepository = $MELIPacksRepository;
        $this->MELIShipmentsRepository = $MELIShipmentsRepository;
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

    public function show(request $request)
    {
        $order_id = $request->route('order');
        $order = $this->MELIordersRepository->getOrder($order_id);

        // dd($order);
        return view('orders.show', compact('order'));
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
        $this->validate($request, [
            'order_id' => 'required|numeric',
        ]);

        $order_id = $request->input('order_id');

        $order = $this->MELIordersRepository->getOrder($order_id);

        if ($order) {
            return redirect()->route('orders.show', ['order' => $order_id]);
        }

        $pack = $this->MELIPacksRepository->getPack($order_id);

        if ($pack) {
            $orders = collect();
            foreach ($pack->orders as $order) {
                $orders->push($this->MELIordersRepository->getOrder($order->id));
            }
            $limit = $total = count($orders);
            $page = 1;
            return view('orders.index', compact('orders', 'total', 'page', 'limit'));
        }

        return redirect()->route('orders.index')->with('error', 'the order does not exist');
    }
}
