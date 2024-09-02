<x-navbar>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>{{ $item->title }}</h2>
                <p>{{ $item->id }}</p>
                <p>{{ $item->price }}</p>
            </div>
            {{-- <div class="col-md-6">
                <img src="{{ asset('storage/images/' . $item->image) }}" alt="{{ $item->name }}" class="img-fluid">
            </div> --}}
        </div>
    </div>
</x-navbar>
