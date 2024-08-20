<x-navbar>
    <div class="container mt-5">
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>{{ $order->id }}</h4>
                <form action="{{ route('label.print') }}" method="POST" style="display:inline;">
                    @csrf
                    <input type="hidden" name="order" value="{{ json_encode($order) }}">
                    <button type="submit"
                        class="btn btn-secondary ml-auto">{{ $shipment->substatus ?? $shipment->status }}</button>
                </form>
            </div>
            <div class="card-body">
                <h5 class="card-title">Pack ID: <span class="text-secondary">{{ $order->pack_id ?? 'N/A' }}</span></h5>
                <p class="card-text">Order Date: <span class="text-muted">{{ $order->date_created }}</span></p>
                <h6 class="mt-4">Items:</h6>
                <ul class="list-group">
                    @foreach ($order->order_items as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-1">{{ $item->item->title }}</h5>
                                <small class="text-muted">MLM: {{ $item->item->id }}</small><br>
                                <small class="text-muted">SKU: {{ $item->item->seller_sku }}</small><br>
                                <small class="text-muted">Custom SKU: {{ $item->item->seller_custom_field }}</small>
                            </div>
                            <span class="badge badge-secondary badge-pill">Quantity: {{ $item->quantity }}</span>
                        </li>
                    @endforeach
                </ul>

                <h6 class="mt-4">Payment Info:</h6>

                <div class="list-group">
                    <div class="list-group-item">
                        <ul class="list-unstyled">
                            @foreach ($order->payments as $payment)
                                <li>Payment ID: <span class="text-muted">{{ $payment->id }}</span></li>
                                <li>Status: <span class="text-muted">{{ $payment->status }}</span></li>
                                <li>Status Detail: <span class="text-muted">{{ $payment->status_detail }}</span></li>
                                <li>Transaction Amount: <span
                                        class="text-muted">{{ $payment->transaction_amount }}</span></li>
                                <li>Total Paid Amount: <span
                                        class="text-muted">{{ $payment->total_paid_amount }}</span></li>
                                <li>Marketplace Fee: <span class="text-muted">{{ $payment->marketplace_fee }}</span>
                                </li>
                                <hr>
                            @endforeach

                        </ul>
                    </div>
                </div>

                <h6 class="mt-4">Status History:</h6>

                <div class="list-group">
                    <div class="list-group-item">
                        <ul class="list-unstyled">
                            @php
                                $statusHistory = [
                                    'date_shipped' => 'Date Shipped',
                                    'date_returned' => 'Date Returned',
                                    'date_delivered' => 'Date Delivered',
                                    'date_first_visit' => 'Date First Visit',
                                    'date_not_delivered' => 'Date Not Delivered',
                                    'date_cancelled' => 'Date Cancelled',
                                    'date_returned_to_sender' => 'Date Returned to Sender',
                                    'date_handling' => 'Date Handling',
                                    'date_ready_to_ship' => 'Date Ready to Ship',
                                ];
                            @endphp

                            @foreach ($statusHistory as $key => $label)
                                @if (property_exists($shipment->status_history, $key) &&
                                        $shipment->status_history->$key !== 'N/A' &&
                                        $shipment->status_history->$key !== null)
                                    <li>{{ $label }}: <span
                                            class="text-muted">{{ $shipment->status_history->$key }}</span></li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>


            </div>
        </div>
    </div>
</x-navbar>
p
