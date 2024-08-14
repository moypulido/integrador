<x-navbar>

    <div class="container mt-4">
        <h1>User Orders</h1>
        <form id="searchForm" action="{{ route('orders.index') }}" method="GET">
            <div class="input-group flex-nowrap mt-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-search"></i></span>
                </div>
                <input type="text" class="form-control" name="order_id" placeholder="Order id" aria-label="Order id"
                    aria-describedby="addon-wrapping">
            </div>
        </form>
    </div>


    <tbody>
        @foreach ($orders as $order)
            <x-order :order="$order" />
        @endforeach
    </tbody>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('input[name="order_id"]');
            searchInput.addEventListener('keypress', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    document.getElementById('searchForm').submit();
                }
            });
        });
    </script>
</x-navbar>
