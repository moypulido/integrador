@if (session('success'))
    <div id="success-message" class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div id="error-message" class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if (session('warning'))
    <div id="warning-message" class="alert alert-warning">
        {{ session('warning') }}
    </div>
@endif

@if (session('info'))
    <div id="info-message" class="alert alert-info">
        {{ session('info') }}
    </div>
@endif
