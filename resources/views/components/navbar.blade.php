<!-- resources/views/components/navbar.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-1">
                <div class="d-flex flex-column vh-100">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light flex-column">
                        <a class="navbar-brand" href="{{ route('informacion.index') }}">integrador</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav flex-column vh-100">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('informacion.index') }}">Informacion</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('orders.index') }}">orders</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>

            <div class="col-10">
                {{ $slot }}
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
