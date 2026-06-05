<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Inicio') - Biblioteca</title>
 
    {{-- Tailwind CSS vía CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen flex flex-col">
 
    {{-- ============ NAVBAR ============ --}}
    <nav class="bg-slate-900 text-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ route('books.index') }}" class="text-xl font-bold flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5
                             S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18
                             s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5
                             c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18
                             c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                Biblioteca
            </a>
 
            <div class="hidden md:flex items-center gap-6">
                <a href="{{ route('books.index') }}"
                   class="hover:text-amber-300 transition">Catálogo</a>
                <a href="{{ route('authors.index') }}"
                   class="hover:text-amber-300 transition">Autores</a>
            </div>
 
            {{-- Auth placeholder — se completará en Guía 8 --}}
            <div class="flex items-center gap-3">
                <a href="#" class="text-sm text-slate-300 hover:text-white">Login</a>
                <a href="#"
                   class="text-sm bg-amber-600 hover:bg-amber-700 px-3 py-1 rounded">
                    Registro
                </a>
            </div>
        </div>
    </nav>
 
    {{-- ============ MENSAJES FLASH ============ --}}
    @if(session('success'))
        <div class="container mx-auto px-4 mt-4">
            <div class="bg-green-100 border-l-4 border-green-500 text-green-800
                        px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        </div>
    @endif
 
    @if(session('error'))
        <div class="container mx-auto px-4 mt-4">
            <div class="bg-red-100 border-l-4 border-red-500 text-red-800
                        px-4 py-3 rounded">
                {{ session('error') }}
            </div>
        </div>
    @endif
 
    {{-- ============ CONTENIDO ============ --}}
    <main class="container mx-auto px-4 py-8 flex-grow">
        @yield('content')
    </main>
 
    {{-- ============ FOOTER ============ --}}
    <footer class="bg-slate-900 text-slate-300 mt-12 py-6">
        <div class="container mx-auto px-4 text-center text-sm">
            &copy; {{ date('Y') }} Universidad Autónoma Tomás Frías —
            Ingeniería Informática — INF560
        </div>
    </footer>
 
</body>
</html>
