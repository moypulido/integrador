<x-navbar>

    <div class="container mt-4">

        <h1>{{ __('messages.Items') }}</h1>

        <br>

        <div class="d-flex justify-content-between container mt-2">
            <div class="container bg-light p-4 rounded shadow-sm">
                <div class="row mb-3">
                    <div class="col">
                        <a href="{{ $response->seller->permalink }}" target="_blank" class="text-primary font-weight-bold">
                            {{ $response->seller->nickname }}
                        </a>
                    </div>
                    <div class="col text-muted">
                        <strong>{{ __('messages.registration_date') }}:</strong>
                        {{ formatDate($response->seller->registration_date) }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <strong>{{ __('messages.seller_reputation') }}:</strong>
                        <span class="badge badge-secondary">{{ $response->seller->seller_reputation->level_id }}</span>
                    </div>
                    <div class="col">
                        <strong>{{ __('messages.power_seller_status') }}:</strong>
                        <span
                            class="badge badge-secondary">{{ $response->seller->seller_reputation->power_seller_status }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <strong>{{ __('messages.total_transactions') }}:</strong>
                        <span
                            class="badge badge-secondary">{{ $response->seller->seller_reputation->transactions->total }}</span>
                    </div>
                    <div class="col">
                        <strong>{{ __('messages.total_canceled') }}:</strong>
                        <span
                            class="badge badge-secondary">{{ $response->seller->seller_reputation->transactions->canceled }}</span>
                    </div>
                    <div class="col">
                        <strong>{{ __('messages.total_completed') }}:</strong>
                        <span
                            class="badge badge-secondary">{{ $response->seller->seller_reputation->transactions->completed }}</span>
                    </div>
                </div>
            </div>
        </div>

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
                <div class="modal fade" id="filtersModal" tabindex="-1" aria-labelledby="filtersModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="filtersModalLabel">Filtros y Ordenamiento</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="sort">Ordenar por:</label>
                                    <select name="sort" id="sort" class="form-control">
                                        @foreach ($response->available_sorts as $sort)
                                            <option value="{{ $sort->id }}">{{ $sort->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="filters">Filtros:</label>
                                    @foreach ($response->available_filters as $filter)
                                        <div class="form-group">
                                            <label>{{ $filter->name }}:</label>
                                            @foreach ($filter->values as $value)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="filters[{{ $filter->id }}][]"
                                                        value="{{ $value->id }}"
                                                        id="filter_{{ $filter->id }}_{{ $value->id }}">
                                                    <label class="form-check-label"
                                                        for="filter_{{ $filter->id }}_{{ $value->id }}">
                                                        {{ $value->name }} ({{ $value->results }})
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Aplicar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <br>
        <br>

        @foreach ($response->results as $item)
            <div class="card" style="width: 18rem;">
                <h5 class="card-title">{{ $item->id }}</h5>
                <p class="card-text">{{ $item->title }}</p>
            </div>
        @endforeach
    </div>

</x-navbar>

<script>
    $('#filtersModal').on('shown.bs.modal', function() {
        $('#myInput').trigger('focus')
    })
</script>
