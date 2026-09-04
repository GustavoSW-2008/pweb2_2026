<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Loja de Sofás</title>
    <!-- Seus links de CSS / Tailwind aqui -->
</head>
<body>
    <!-- Seu menu superior ou lateral -->
    @include('sidebar') 

    <main class="p-4">
        <!-- Esta diretiva é obrigatória para injetar o código do list.blade.php aqui -->
        @yield('content')
    </main>
</body>
</html>