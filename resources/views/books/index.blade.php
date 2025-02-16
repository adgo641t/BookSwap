<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    <title>Book Swap</title>
</head>
<body>
    
<nav class="bg-gray-800 p-4">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Logo o Nombre del sitio -->
        <div class="text-white text-lg font-semibold">
            <a href="/">Book Swap</a>
        </div>

        <!-- Menú de navegación -->
        <div class="space-x-4">
            @guest
                <!-- Si no está logueado, mostrar Login y Registro -->
                <a href="{{ route('login') }}" class="text-white hover:text-gray-300">Login</a>
                <a href="{{ route('register') }}" class="text-white hover:text-gray-300">Registro</a>

            @else
                <!-- Si está logueado, mostrar el nombre del usuario y Logout -->
                <span class="text-white">Bienvenido, {{ Auth::user()->name }}</span>
                <a href="{{ route('admin') }}" class="text-white hover:text-gray-300">Admin de libros</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-white hover:text-gray-300">Logout</button>
                </form>
                <span class="text-white">Credito: {{ Auth::user()->credit }}</span>
            @endguest
        </div>
    </div>
</nav>
<div class="container mx-auto p-6">
    <h2 class="text-3xl font-bold text-center mb-6">📚 Libros Disponibles para Intercambio</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($books as $book)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                @if($book->image)
                    <img src="https://picsum.photos/600/300" class="w-full h-64 object-cover" alt="{{ $book->title }}">
                @else
                    <div class="w-full h-64 bg-gray-300 flex items-center justify-center">
                        <span class="text-gray-500">Sin imagen</span>
                    </div>
                @endif

                <div class="p-4">
                    <h3 class="text-xl font-semibold">{{ $book->title }}</h3>
                    <p class="text-gray-600">Autor: <span class="font-medium">{{ $book->author }}</span></p>
                    <p class="text-gray-500 text-sm mt-2">{{ Str::limit($book->description, 100) }}</p>
                    <p class="text-gray-600">Ubi: <span class="font-medium">{{ $book->ubicacion }}</span></p>
                    
                    <div class="mt-4 flex justify-between items-center">
                        <span class="text-sm text-gray-400">Publicado por: {{ $book->user->name }}</span>

                        @auth
                            @if($book->user_id !== auth()->id())
                                <form action="{{ url('/swap/' . $book->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                                        Solicitar Intercambio
                                    </button>
                                </form>
                            @else
                                <span class="text-xs text-gray-500">Este es tu libro</span>
                            @endif
    
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if(session('success'))
        <div class="mt-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif
</div>
</body>
</html>
