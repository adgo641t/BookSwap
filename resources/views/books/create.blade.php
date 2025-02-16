<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>Form Book</title>
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
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-white hover:text-gray-300">Logout</button>
                </form>
                <span class="text-white">Credito: {{ Auth::user()->credit }}</span>
            @endguest
        </div>
    </div>
</nav>
<br>
<form action="{{ route('crear') }}" method="POST" enctype="multipart/form-data" class="max-w-lg mx-auto p-6 bg-white shadow-md rounded-lg">
    @csrf
    <div class="mb-4">
        <label for="titulo" class="block text-gray-700 font-bold mb-2">Título:</label>
        <input type="text" name="titulo" id="titulo" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
    </div>

    <div class="mb-4">
        <label for="autor" class="block text-gray-700 font-bold mb-2">Autor:</label>
        <input type="text" name="autor" id="autor" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
    </div>

    <div class="mb-4">
        <label for="descripcion" class="block text-gray-700 font-bold mb-2">Descripción:</label>
        <textarea name="descripcion" id="descripcion" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
    </div>

    <div class="mb-4">
        <label for="imagen" class="block text-gray-700 font-bold mb-2">Imagen:</label>
        <input type="file" name="imagen" id="imagen" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
    </div>

    <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">
        Guardar
    </button>
</form>

</body>
</html>