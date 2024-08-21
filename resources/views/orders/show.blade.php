<x-navbar>
    <div class="container mt-5">
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>{{ $order->id }}</h4>
                <form action="{{ route('label.print') }}" method="POST" style="display:inline;">
                    @csrf
                    <input type="hidden" name="order" value="{{ json_encode($order) }}">
                    <button type="submit"
                        class="btn btn-secondary ml-auto">{{ __('messages.' . $shipment->substatus) ?? __('messages.' . $shipment->status) }}</button>
                </form>
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ __('messages.Pack ID') }}: <span
                        class="text-secondary">{{ $order->pack_id ?? 'N/A' }}</span></h5>
                <p class="card-text">{{ __('messages.Order Date') }}: <span
                        class="text-muted">{{ $order->date_created }}</span></p>



                <h6 class="mt-4">{{ __('messages.Items') }}:</h6>

                <ul class="list-group">
                    @foreach ($order->order_items as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-1">{{ $item->item->title }}</h5>
                                <small class="text-muted">MLM: {{ $item->item->id }}</small><br>
                                <small class="text-muted">SKU: {{ $item->item->seller_sku }}</small><br>
                                <small class="text-muted">{{ __('messages.Custom SKU') }}:
                                    {{ $item->item->seller_custom_field }}</small>
                            </div>
                            <span class="badge badge-secondary badge-pill">{{ __('messages.Quantity') }}:
                                {{ $item->quantity }}</span>
                        </li>
                    @endforeach
                </ul>

                <h6 class="mt-4">{{ __('messages.Payment Info') }}:</h6>

                <div class="list-group">
                    <div class="list-group-item">
                        <ul class="list-unstyled">
                            @foreach ($order->payments as $payment)
                                <li>{{ __('messages.Payment ID') }}: <span
                                        class="text-muted">{{ $payment->id }}</span></li>
                                <li>{{ __('messages.Status') }}: <span
                                        class="text-muted">{{ __('messages.' . $payment->status) }}</span></li>
                                <li>{{ __('messages.Status Detail') }}: <span
                                        class="text-muted">{{ __('messages.' . $payment->status_detail) }}</span></li>
                                <li>{{ __('messages.Transaction Amount') }}: <span
                                        class="text-muted">{{ number_format($payment->transaction_amount, 2) }}</span>
                                </li>
                                <li>{{ __('messages.Total Paid Amount') }}: <span
                                        class="text-muted">{{ number_format($payment->total_paid_amount, 2) }}</span>
                                </li>
                                <li>{{ __('messages.Marketplace Fee') }}: <span
                                        class="text-muted">{{ number_format($payment->marketplace_fee, 2) }}</span>
                                </li>
                                <hr>
                            @endforeach

                        </ul>
                    </div>
                </div>

                <h6 class="mt-4">{{ __('messages.Status History') }}:</h6>

                <div class="list-group">
                    <div class="list-group-item">
                        <ul class="list-unstyled">
                            @php
                                $statusHistory = [
                                    'date_shipped' => __('messages.date_shipped'),
                                    'date_returned' => __('messages.date_returned'),
                                    'date_delivered' => __('messages.date_delivered'),
                                    'date_first_visit' => __('messages.date_first_visit'),
                                    'date_not_delivered' => __('messages.date_not_delivered'),
                                    'date_cancelled' => __('messages.date_cancelled'),
                                    'date_returned_to_sender' => __('messages.date_returned_to_sender'),
                                    'date_handling' => __('messages.date_handling'),
                                    'date_ready_to_ship' => __('messages.date_ready_to_ship'),
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
