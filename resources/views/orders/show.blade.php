<x-navbar>
    <div class="container mt-5">
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>{{ $order->id }}</h4>
                <form action="{{ route('orders.show', ['order' => $order->id]) }}" method="GET" style="display:inline;">
                    <button type="submit"
                        class="btn btn-secondary ml-auto">{{ $shipmet->substatus ?? 'entregado' }}</button>
                </form>
            </div>
            <div class="card-body">
                <h6 class="card-title">Pack ID: {{ $order->pack_id ?? 'N/A' }}</h6>
                <p class="card-text">Order Date: {{ $order->date_created }}</p>
                <h6 class="mt-4">Items:</h6>
                <ul class="list-group">
                    @foreach ($order->order_items as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <h6>{{ $item->item->title }}
                                    <br>
                                    MLM: {{ $item->item->id }}
                                    <br>
                                    SKU: {{ $item->item->seller_sku }}
                                </h6>
                            </div>
                            <span>Quantity: {{ $item->quantity }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-navbar>
