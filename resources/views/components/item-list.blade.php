<div class="card mb-3">
    {{-- <a href="{{ route('items.show', $item->id) }}"> --}}
    <div class="row g-0">
        <!-- Main image (8:4 ratio on medium, 12:12 on small) -->
        <div class="col-md-2 col-10 d-flex flex-column justify-content-center align-items-center">
            @if ($item->catalog_listing)
                <p class="small mt-2">{{ __('messages.catalog') }}</p>
            @else
                <p class="small mt-2">{{ __('messages.traditional') }}</p>
            @endif
            <img src="{{ $item->thumbnail }}" class="img-fluid rounded-start" alt="{{ $item->title }}"
                style="width: 100%; max-width: 90px;">
            <p class="small mt-2">{{ $item->id }}</p>

        </div>
        <!-- Product details -->
        <div class="col-md-10 col-12">
            <div class="d-flex justify-content-between mr-4 mt-4">
                <h5 class="card-title"><a href="{{ route('items.show', $item->id) }}">{{ $item->title }}</a></h5>
                <p class="small mt-2"><strong>{{ __('messages.Quality') }}:</strong>{{ $item->health }}</p>
                <a href="{{ $item->permalink }}" target="_blank">
                    {{ __('messages.see_in_mercadolibre') }}
                </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 col-12">
                        <p class="card-text mb-1"><strong>{{ __('messages.Price') }}:</strong>
                            ${{ number_format($item->price, 2) }}
                            {{ $item->currency_id }}</p>
                        <p class="card-text mb-1"><strong>{{ __('messages.Sold_Quantity') }}:</strong>
                            {{ $item->sold_quantity }}</p>
                        <p class="card-text mb-1"><strong>{{ __('messages.Available_Quantity') }}:</strong>
                            {{ $item->available_quantity }}
                        </p>
                    </div>
                    <div class="col-md-4 col-12">
                        <p class="card-text mb-1"><strong>{{ __('messages.type_publication') }}:</strong>
                            {{ __('messages.listing_type_id.' . $item->listing_type_id) }}</p>
                        <p class="card-text mb-1"><strong>{{ __('messages.Status') }}:</strong>
                            {{ __('messages.Items_status.' . $item->status) }}</p>
                        <p class="card-text mb-1"><strong>{{ __('messages.sub_status') }}:</strong>
                            @foreach ($item->sub_status as $sub_status)
                                {{ __('messages.sub_statuses.' . $sub_status) }},
                            @endforeach
                        </p>
                    </div>
                    <div class="col-md-4 col-12">
                        <p class="card-text mb-1"><strong>{{ __('messages.seler_sku') }}:</strong>
                            {{ $item->seller_custom_field }}</p>
                        <p class="card-text mb-1"><strong>{{ __('messages.shipping_mode') }}:</strong>
                            {{ __('messages.shiping_statues.' . $item->shipping->mode) }}</p>
                        <p class="card-text mb-1"><strong>{{ __('messages.shipping_logistic_type') }}:</strong>
                            {{ __('messages.shiping_statues.' . $item->shipping->logistic_type) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- </a> --}}
</div>
