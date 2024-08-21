<!-- resources/views/components/navbar.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-1.2 d-flex flex-column">
                <nav class="navbar navbar-expand-lg navbar-light bg-light flex-column flex-grow-1">
                    <a class="navbar-brand" href="{{ route('informacion.index') }}">{{ __('messages.Integrator') }}</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse flex-column flex-grow-1" id="navbarNav">
                        <ul class="navbar-nav flex-column flex-grow-1">
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="{{ route('informacion.index') }}">{{ __('messages.Informacion') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('orders.index') }}">{{ __('messages.Orders') }}</a>
                            </li>

                            {{-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Dropdown
                                </a>
                                <div href= '#' class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                </div>
                            </li> --}}

                        </ul>
                    </div>
                </nav>
            </div>

            <div class="col-10">
                <x-messages />
                {{ $slot }}
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- JavaScript para eliminar mensajes después de 10 minutos -->
    <script>
        setTimeout(function() {
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.remove();
            }

            var errorMessage = document.getElementById('error-message');
            if (errorMessage) {
                errorMessage.remove();
            }

            var warningMessage = document.getElementById('warning-message');
            if (warningMessage) {
                warningMessage.remove();
            }

            var infoMessage = document.getElementById('info-message');
            if (infoMessage) {
                infoMessage.remove();
            }
        }, 5000);
    </script>
</body>

</html>
