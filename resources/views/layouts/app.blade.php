<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Deputados e Despesas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('index.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('deputados.index') }}">
            <img src="{{ asset('img/deputado-icon.png') }}" alt="Deputado" style="width: 30px; filter: brightness(0) invert(1); margin-right: 10px;">
            Gerenciamento de Despesas dos Deputados
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('deputados.index') }}">
                        <i class="bi bi-house-door-fill"></i> Início
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="bi bi-bar-chart-fill"></i> Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('deputados.comparar') }}">
                        <i class="bi bi-people-fill"></i> Comparar Deputados
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
    <div class="container">
        @yield('content')
    </div>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
</body>
</html>
