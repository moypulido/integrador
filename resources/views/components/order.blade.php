<div class="container mt-2">
    <div class="card mb-1">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>{{ $order->id }}</h4>
            <div style="display:inline;">
                <form action="{{ route('label.print') }}" method="POST" style="display:inline;">
                    @csrf
                    <input type="hidden" name="order" value="{{ json_encode($order) }}">
                    <button type="submit" class="btn btn-secondary ml-auto">{{ __('messages.Print label') }}</button>
                </form>
                <form action="{{ route('orders.show', ['order' => $order->id]) }}" method="GET"
                    style="display:inline;">
                    <button type="submit" class="btn btn-secondary ml-auto">{{ __('messages.Informacion') }}</button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <h6 class="card-title">{{ __('messages.Pack ID') }}: {{ $order->pack_id ?? 'N/A' }}</h6>
            <p class="card-text">{{ __('messages.Order Date') }}: {{ $order->date_created }}</p>
            <p class="card-text">{{ __('messages.Status') }}: {{ __('messages.' . $order->status) }}</p>
            <p class="card-text">{{ __('messages.Total') }}: ${{ number_format($order->total_amount, 2) }}</p>
            <h6 class="mt-4">{{ __('messages.Items') }}:</h6>
            <ul class="list-group">
                @foreach ($order->order_items as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $item->item->title }}
                        <span class="badge badge-secondary badge-pill">{{ __('messages.Quantity') }}:
                            {{ $item->quantity }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
