@extends('main')

@section('titulo', 'Login - Pausa Sofás')

@section('content')
<div class="row justify-content-center my-5">
    <div class="col-md-5">
        <div class="card shadow-lg border-0">
            <div class="card-header text-white text-center py-4" style="background-color: var(--brand-primary);">
                <i class="bi bi-shield-lock fs-1 d-block mb-2"></i>
                <h4 class="mb-0 fw-bold">Pausa Sofás</h4>
                <small class="text-white-50">Sistema de Gestão e Catálogo</small>
            </div>
            <div class="card-body p-4 bg-white">
                <form action="{{ route('login.submit') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">
                            <i class="bi bi-envelope me-1"></i> E-mail
                        </label>
                        <input type="email" name="email" id="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                               value="{{ old('email', 'admin@pausasofas.com') }}" required autofocus placeholder="seu.email@exemplo.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">
                            <i class="bi bi-lock me-1"></i> Senha
                        </label>
                        <input type="password" name="password" id="password" class="form-control form-control-lg @error('password') is-invalid @enderror"
                               value="12345678" required placeholder="Sua senha">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" name="remember" id="remember" class="form-check-input">
                        <label class="form-check-label text-muted" for="remember">Lembrar-me neste computador</label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100 shadow-sm" style="background-color: var(--brand-secondary);">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Entrar no Sistema
                    </button>
                </form>

                <div class="alert alert-info mt-4 mb-0 small">
                    <i class="bi bi-info-circle-fill me-1"></i>
                    <strong>Credenciais para avaliação:</strong><br>
                    <strong>E-mail:</strong> <code>admin@pausasofas.com</code><br>
                    <strong>Senha:</strong> <code>12345678</code>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
