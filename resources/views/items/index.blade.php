<x-navbar>

    <div class="container mt-4">

        <h1>{{ __('messages.Items') }}</h1>
        <br>

        <div class="d-flex justify-content-between container mt-4">
            <form method="GET" action="{{ route('items.index') }}">
                <div class="input-group flex-nowrap">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="addon-wrapping"><i class="fas fa-search"></i></span>
                    </div>
                    <input type="text" class="form-control" name="search" placeholder="Buscar" aria-label="Buscar"
                        aria-describedby="addon-wrapping">
                </div>
            </form>

            <form method="GET" action="{{ route('items.index') }}">

                <!-- Botón para abrir el modal -->
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#filtersModal">
                    Filtros y Ordenamiento
                </button>

                <!-- Modal -->
                <div class="modal fade" id="filtersModal" tabindex="-1" role="dialog"
                    aria-labelledby="filtersModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="filtersModalLabel">Filtros y Ordenamiento</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">


                                <!-- Ordenamientos -->
                                <h6>{{ __('messages.Sort by') }}</h6>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text"
                                            for="orderSelect">{{ __('messages.Options') }}</label>
                                    </div>
                                    <select class="custom-select" id="orderSelect" name="order">
                                        @foreach ($response->available_orders as $order)
                                            @if (is_string($order->id))
                                                <option value="{{ $order->id }}"
                                                    {{ $order->id == $response->orders[0]->id ? 'selected' : '' }}>
                                                    {{ __('messages.sort_options.' . $order->id) }}
                                                </option>
                                            @elseif(is_object($order->id) && isset($order->id->id))
                                                <option value="{{ $order->id->id }}"
                                                    {{ $order->id->id == $response->orders[0]->id ? 'selected' : '' }}>
                                                    {{ __('messages.sort_options.' . $order->id->id) }}
                                                </option>
                                            @else
                                                <option disabled>Invalid option for {{ $order->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>


                                <!-- Filtros -->
                                <h6>{{ __('messages.available_filters') }}</h6>
                                @foreach ($response->available_filters as $filter)
                                    <div class="filter-group">
                                        <h6>{{ __('messages.filters.' . $filter->id) }}</h6>
                                        <!-- Translate filter names -->
                                        <ul>
                                            @if (property_exists($filter, 'values'))
                                                @foreach ($filter->values as $value)
                                                    @if (property_exists($value, 'id') && property_exists($value, 'results'))
                                                        <!-- Checkbox for each filter value -->
                                                        <li>
                                                            <label>
                                                                <input type="checkbox"
                                                                    name="filters[{{ $filter->id }}][]"
                                                                    value="{{ $value->id }}">
                                                                {{ __('messages.filter_values.' . $value->id) }}
                                                                ({{ $value->results }})
                                                            </label>
                                                        </li>
                                                    @else
                                                        <li>{{ __('messages.value_info_unavailable') }}</li>
                                                    @endif
                                                @endforeach
                                        </ul>
                                    @else
                                        <p>{{ __('messages.no_values_available') }}</p>
                                @endif
                            </div>
                            @endforeach



                        </div>
                        <div class="modal-footer">
                            <form method="GET" action="{{ route('items.index') }}">
                                <button type="submit" class="btn btn-light">Limpiar Filtros</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-secondary">Aplicar Filtros</button>
                        </div>
                    </div>
                </div>
        </div>
        </form>

    </div>

    <br>
    <div class="d-flex mx-auto" style="gap: 3rem;">

        <p class="small">{{ __('messages.Total') }}: {{ $response->paging->total ?? __('messages.no_results') }}</p>
        <p class="small">|</p>

        <!-- Display the applied sort option -->
        @if (!empty($response->orders))
            @foreach ($response->orders as $order)
                <p class="small">{{ __('messages.sort_options.' . $order->id) }}</p>
            @endforeach
        @else
            <p class="small">{{ __('messages.no_sort_applied') }}</p>
        @endif

        <p class="small">|</p>

        <!-- Display the applied filters and their values -->
        @if (!empty($response->filters))
            @foreach ($response->filters as $filter)
                <p class="small">{{ __('messages.filters.' . $filter->id) }}:
                    @foreach ($filter->values as $value)
                        {{ __('messages.filter_values.' . $value->id) }}
                    @endforeach
                </p>
            @endforeach
        @else
            <p class="small">{{ __('messages.no_filters_applied') }}</p>
        @endif
        <br>

        <br>

    </div>

    <br>
    <br>

    @foreach ($response->results as $item_id)
        <x-item-list :item="$item_id" />
    @endforeach



</x-navbar>


<script>
    $('#filtersModal').on('shown.bs.modal', function() {
        $('#myInput').trigger('focus')
    })
</script>
