<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo', 'Pausa Sofás - Sistema de Gestão')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --brand-primary: #1a3a5c;
            --brand-secondary: #234b82;
            --brand-accent: #f39c12;
        }
        body {
            background-color: #f8fafc;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .navbar-custom {
            background-color: var(--brand-primary);
            box-shadow: 0 2px 4px rgba(0,0,0,.08);
        }
        .navbar-custom .nav-link {
            color: rgba(255,255,255,.85);
            font-weight: 500;
            padding: 0.5rem 0.85rem;
            border-radius: 4px;
            transition: all 0.2s ease;
        }
        .navbar-custom .nav-link:hover,
        .navbar-custom .nav-link.active {
            color: #fff;
            background-color: rgba(255,255,255,.12);
        }
        .navbar-brand {
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.075);
            border-radius: 0.5rem;
        }
        .table-hover tbody tr:hover {
            background-color: rgba(26, 58, 92, 0.04);
        }
        .avatar-thumbnail {
            width: 48px;
            height: 48px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #dee2e6;
        }
        .product-thumbnail {
            width: 60px;
            height: 45px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #ced4da;
        }
        footer {
            margin-top: auto;
            background-color: #ffffff;
            border-top: 1px solid #e9ecef;
            padding: 1.25rem 0;
            color: #6c757d;
            font-size: 0.875rem;
        }
    </style>
    @yield('styles')
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom mb-4 sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
                <i class="bi bi-shop me-2 fs-4"></i> Pausa Sofás
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navPausa" aria-controls="navPausa" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navPausa">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="bi bi-speedometer2 me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('sofas.*') ? 'active' : '' }}" href="{{ route('sofas.index') }}">
                            <i class="bi bi-box-seam me-1"></i> Sofás
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('fichas-tecnicas.*') ? 'active' : '' }}" href="{{ route('fichas-tecnicas.index') }}">
                            <i class="bi bi-card-checklist me-1"></i> Fichas Técnicas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('clientes.*') ? 'active' : '' }}" href="{{ route('clientes.index') }}">
                            <i class="bi bi-people me-1"></i> Clientes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('fornecedores.*') ? 'active' : '' }}" href="{{ route('fornecedores.index') }}">
                            <i class="bi bi-truck me-1"></i> Fornecedores
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('vendas.*') ? 'active' : '' }}" href="{{ route('vendas.index') }}">
                            <i class="bi bi-cart-check me-1"></i> Vendas
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-file-earmark-pdf me-1 text-danger"></i> Relatórios PDF
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('sofas.report') }}">
                                    <i class="bi bi-file-pdf text-danger me-2"></i> Relatório de Sofás
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('clientes.report') }}">
                                    <i class="bi bi-file-pdf text-danger me-2"></i> Relatório de Clientes
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container my-3 flex-grow-1">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <strong><i class="bi bi-x-octagon-fill me-2"></i> Verifique os erros no formulário:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        @endif

        @yield('content')
        @yield('conteudo')
    </main>

    <footer>
        <div class="container text-center">
            <span>&copy; {{ date('Y') }} Pausa Sofás - IFSC Câmpus Chapecó</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
