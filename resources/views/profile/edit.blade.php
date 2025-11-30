<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Perfil • StockOne</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans text-gray-900">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Editar Perfil
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Atualize suas informações pessoais
                </p>
            </div>

            @if (session('success'))
                <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                    <p class="font-semibold">Ops! Verifique os campos:</p>
                    <ul class="list-inside list-disc mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="mt-8 space-y-6 rounded-2xl border border-gray-100 bg-white p-8 shadow-sm" action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            Nome
                        </label>
                        <input
                            id="name"
                            name="name"
                            type="text"
                            required
                            value="{{ old('name', $user->name) }}"
                            class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 shadow-sm focus:border-red-500 focus:outline-none focus:ring-red-500"
                        >
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            E-mail
                        </label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            required
                            value="{{ old('email', $user->email) }}"
                            class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 shadow-sm focus:border-red-500 focus:outline-none focus:ring-red-500"
                        >
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Nova Senha (deixe em branco para não alterar)
                        </label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 shadow-sm focus:border-red-500 focus:outline-none focus:ring-red-500"
                        >
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                            Confirmar Nova Senha
                        </label>
                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 shadow-sm focus:border-red-500 focus:outline-none focus:ring-red-500"
                        >
                    </div>
                </div>

                <div class="flex items-center justify-between gap-3">
                    <a href="{{ url()->previous() }}" class="text-sm text-gray-500 hover:text-red-600">
                        &larr; Voltar
                    </a>

                    <div class="flex items-center gap-3">
                        @if(auth()->user()->is_admin)
                            <a href="{{ url('/admin') }}" class="rounded-full border border-gray-200 px-5 py-2 text-sm font-semibold text-gray-600 hover:border-red-200 hover:text-red-600">
                                Painel Admin
                            </a>
                        @endif
                        <button type="submit" class="rounded-full bg-red-600 px-5 py-2 text-sm font-semibold text-white shadow hover:bg-red-500">
                            Atualizar Perfil
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
