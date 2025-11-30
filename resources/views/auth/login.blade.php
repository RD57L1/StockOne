<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>StockOne • Acesso do restaurante</title>
        @if (app()->environment('testing'))
            <style>
                :root {
                    font-family: 'Instrument Sans', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
                }
            </style>
        @else
            @php
                $manifestPath = public_path('build/manifest.json');
            @endphp
            @if (file_exists($manifestPath))
                @vite(['resources/css/app.css', 'resources/js/app.js'])
            @else
                <script>
                    console.warn('Vite manifest not found. Please run: npm run build');
                </script>
                <style>
                    * { margin: 0; padding: 0; box-sizing: border-box; }
                    body { font-family: 'Instrument Sans', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; background-color: #f9fafb; }
                    .min-h-screen { min-height: 100vh; }
                    .flex { display: flex; }
                    .flex-col { flex-direction: column; }
                    .items-center { align-items: center; }
                    .justify-center { justify-content: center; }
                    .px-4 { padding-left: 1rem; padding-right: 1rem; }
                    .mx-auto { margin-left: auto; margin-right: auto; }
                    .w-full { width: 100%; }
                    .max-w-md { max-width: 28rem; }
                    .rounded-3xl { border-radius: 1.5rem; }
                    .border { border-width: 1px; }
                    .border-gray-100 { border-color: #f3f4f6; }
                    .bg-white { background-color: #ffffff; }
                    .p-8 { padding: 2rem; }
                    .shadow-xl { box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); }
                    .mb-8 { margin-bottom: 2rem; }
                    .text-center { text-align: center; }
                    .text-xs { font-size: 0.75rem; line-height: 1rem; }
                    .uppercase { text-transform: uppercase; }
                    .tracking-\[0\.3em\] { letter-spacing: 0.3em; }
                    .text-red-500 { color: #ef4444; }
                    .mt-2 { margin-top: 0.5rem; }
                    .text-3xl { font-size: 1.875rem; line-height: 2.25rem; }
                    .font-semibold { font-weight: 600; }
                    .text-gray-900 { color: #111827; }
                    .text-sm { font-size: 0.875rem; line-height: 1.25rem; }
                    .text-gray-500 { color: #6b7280; }
                    .mb-6 { margin-bottom: 1.5rem; }
                    .rounded-2xl { border-radius: 1rem; }
                    .border-green-200 { border-color: #bbf7d0; }
                    .bg-green-50 { background-color: #f0fdf4; }
                    .px-4 { padding-left: 1rem; padding-right: 1rem; }
                    .py-3 { padding-top: 0.75rem; padding-bottom: 0.75rem; }
                    .text-green-800 { color: #166534; }
                    .border-red-200 { border-color: #fecaca; }
                    .bg-red-50 { background-color: #fef2f2; }
                    .text-red-800 { color: #991b1b; }
                    .space-y-5 > * + * { margin-top: 1.25rem; }
                    .font-semibold { font-weight: 600; }
                    .text-gray-700 { color: #374151; }
                    .rounded-2xl { border-radius: 1rem; }
                    .border-gray-200 { border-color: #e5e7eb; }
                    .focus\:border-red-500:focus { border-color: #ef4444; }
                    .focus\:ring-red-500:focus { --tw-ring-color: #ef4444; }
                    .mt-4 { margin-top: 1rem; }
                    .bg-red-600 { background-color: #dc2626; }
                    .text-white { color: #ffffff; }
                    .shadow-lg { box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); }
                    .shadow-red-200 { box-shadow: 0 10px 15px -3px rgba(239, 68, 68, 0.2), 0 4px 6px -2px rgba(239, 68, 68, 0.1); }
                    .transition { transition-property: color, background-color, border-color, text-decoration-color, fill, stroke; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); transition-duration: 150ms; }
                    .hover\:bg-red-500:hover { background-color: #ef4444; }
                    .mt-8 { margin-top: 2rem; }
                    .text-gray-400 { color: #9ca3af; }
                    input { width: 100%; padding: 0.75rem 1rem; border: 1px solid #e5e7eb; border-radius: 1rem; }
                    input:focus { outline: none; border-color: #ef4444; }
                    button { cursor: pointer; border: none; }
                    .text-red-600 { color: #dc2626; }
                </style>
            @endif
        @endif
    </head>
    <body class="bg-gray-50">
        <div class="min-h-screen flex flex-col items-center justify-center px-4">
            <div class="mx-auto w-full max-w-md rounded-3xl border border-gray-100 bg-white p-8 shadow-xl">
                <div class="mb-8 text-center">
                    <p class="text-xs uppercase tracking-[0.3em] text-red-500">StockOne</p>
                    <h1 class="mt-2 text-3xl font-semibold text-gray-900">Acesso ao painel</h1>
                    <p class="mt-2 text-sm text-gray-500">
                        Informe os dados do restaurante para entrar.
                    </p>
                </div>

                @if (session('success'))
                    <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('auth.login.submit') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label class="text-sm font-semibold text-gray-700">
                            E-mail cadastrado
                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                class="mt-2 w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm focus:border-red-500 focus:ring-red-500"
                            >
                        </label>
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-700">
                            CNPJ
                            <input
                                type="text"
                                name="cnpj"
                                value="{{ old('cnpj') }}"
                                required
                                class="mt-2 w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm focus:border-red-500 focus:ring-red-500"
                            >
                        </label>
                        @error('cnpj')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button
                        type="submit"
                        class="mt-4 w-full rounded-2xl bg-red-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-red-200 transition hover:bg-red-500"
                    >
                        Entrar no painel
                    </button>
                </form>

                <p class="mt-8 text-center text-xs text-gray-400">
                    Em caso de dúvidas, fale com o suporte StockOne.
                </p>
            </div>
        </div>
    </body>
</html>

