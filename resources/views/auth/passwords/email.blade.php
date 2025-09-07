<!doctype html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <title>Elfelejtett jelszó</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Tailwind (CDN, devhez oké) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center p-4">
<div class="w-full max-w-md">
    <!-- kártya -->
    <div class="bg-white/90 backdrop-blur rounded-2xl shadow-xl p-8">
        <!-- logó (opcionális) -->
        <div class="flex items-center gap-3 mb-6">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-8 rounded-md object-contain" onerror="this.style.display='none'">
            <h1 class="text-xl font-semibold text-slate-800">Elfelejtett jelszó</h1>
        </div>

        <p class="text-sm text-slate-600 mb-6">
            Add meg az e-mail címedet, és küldünk egy hivatkozást a jelszó visszaállításához.
        </p>

        {{-- Success üzenet --}}
        @if (session('status'))
            <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-800 text-sm">
                {{ session('status') }}
            </div>
        @endif

        {{-- Hiba üzenet --}}
        @if($errors->any())
            <div class="mb-4 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-rose-800 text-sm">
                {{ $errors->first('email') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1">E-mail cím</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="block w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 px-4 py-2.5 text-slate-800 placeholder-slate-400"
                    placeholder="pelda@domain.hu"
                />
            </div>

            <button
                type="submit"
                class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-4 py-2.5 transition active:scale-[.99]">
                <!-- kis ikon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M2 6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v.35l-10 5.56L2 6.35V6Zm0 2.74v8.26A2 2 0 0 0 4 19h16a2 2 0 0 0 2-2V8.74l-9.35 5.2a2 2 0 0 1-1.3.22 2 2 0 0 1-1.3-.22L2 8.74Z"/>
                </svg>
                Reset link küldése
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('login') }}" class="text-sm text-slate-600 hover:text-slate-800 underline underline-offset-4">
                ← Vissza a bejelentkezéshez
            </a>
        </div>
    </div>

    <!-- apró lábléc -->
    <p class="mt-6 text-center text-xs text-slate-500">
        Ha nem kaptál levelet pár percen belül, nézd meg a spam mappát is.
    </p>
</div>
</body>
</html>
