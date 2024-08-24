<x-navbar>
    <form method="GET" action="{{ route('items.index') }}">
        <div class="form-group">
            <label for="sort">Ordenar por:</label>
            <select name="sort" id="sort" class="form-control">
                @foreach ($response->available_sorts as $sort)
                    <option value="{{ $sort->id }}">{{ $sort->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Botón para abrir el modal -->
        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#filtersModal">
            Filtros
        </button>

        <!-- Modal -->
        <div class="modal fade" id="filtersModal" tabindex="-1" aria-labelledby="filtersModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="filtersModalLabel">Filtros</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="filters">Filtros:</label>
                            @foreach ($response->available_filters as $filter)
                                <div class="form-group">
                                    <label>{{ $filter->name }}:</label>
                                    @foreach ($filter->values as $value)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                name="filters[{{ $filter->id }}][]" value="{{ $value->id }}"
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

    @foreach ($response->results as $item)
        <div class="card" style="width: 18rem;">
            <h5 class="card-title">{{ $item->id }}</h5>
            <p class="card-text">{{ $item->title }}</p>
        </div>
    @endforeach
</x-navbar>

<script>
    $('#filtersModal').on('shown.bs.modal', function() {
        $('#myInput').trigger('focus')
    })
</script>
