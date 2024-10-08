<x-navbar>

    <div class="container mt-4">
        <h1>{{ __('messages.Orders') }}</h1>
        <form action="{{ route('orders.search') }}" method="GET">
            <div class="input-group flex-nowrap mt-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-search"></i></span>
                </div>
                <input type="text" class="form-control" name="order_id" placeholder="Order id" aria-label="Order id"
                    aria-describedby="addon-wrapping">
            </div>

        </form>
    </div>

    <div class="container mt-4">
        <table class="table">
            <tbody>
                @foreach ($orders as $order)
                    <x-order :order="$order" />
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="container mt-5">
        <a style="margin-bottom: 10px; display: inline-block;">
            <span>{{ __('messages.Page') }} {{ $page }}</span>
        </a>
        <ul class="pagination">
            @if ($page > 1)
                <li class="page-item">
                    <a class="page-link"
                        href="{{ route('orders.index', ['page' => $page - 1]) }}">{{ __('messages.Previous') }}</a>
                </li>
            @endif

            @if ($page < ceil($total / $limit))
                <li class="page-item">
                    <a class="page-link"
                        href="{{ route('orders.index', ['page' => $page + 1]) }}">{{ __('messages.Next') }}</a>
                </li>
            @endif
        </ul>
    </div>

    <br>
    <br>
    <br>
    <br>

</x-navbar>
