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
<td class="px-4 py-2"><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"><a href="{{route('create')}}" style="text-decoration:none">Create new Book</a></button></td>
<h1>All my books</h1>
<table class="min-w-full table-auto border-collapse">
    <thead>
        <tr class="bg-gray-100 text-left border-b">
            <th class="px-4 py-2 font-semibold text-sm text-gray-700">Libro</th>
            <th class="px-4 py-2 font-semibold text-sm text-gray-700">author</th>
            <th class="px-4 py-2 font-semibold text-sm text-gray-700">descripcion</th>
            <th class="px-4 py-2 font-semibold text-sm text-gray-700">Estado</th>
            <th class="px-4 py-2 font-semibold text-sm text-gray-700">Accion</th>
            <th class="px-4 py-2 font-semibold text-sm text-gray-700"></th>
            <th class="px-4 py-2 font-semibold text-sm text-gray-700"></th>


        </tr>
    </thead>  
        @foreach($allBoksUser as $books)
            <tr>
                <td>{{$books->title}}</td>
                <td>{{$books->author}}</td>
                <td>{{$books->description}}</td>
                <td>{{$books->status}}</td>
                <form action="{{ route('delete', $books->id) }}" method="POST">
                    @csrf
                   @method('POST')
                    <td class="px-4 py-2"><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Delete</button></td>
                    </form>
            </tr>
        @endforeach
</table>
<h1>Swap Trade</h1>
<table class="min-w-full table-auto border-collapse">
    <thead>
        <tr class="bg-gray-100 text-left border-b">
            <th class="px-4 py-2 font-semibold text-sm text-gray-700">Libro</th>
            <th class="px-4 py-2 font-semibold text-sm text-gray-700">De</th>
            <th class="px-4 py-2 font-semibold text-sm text-gray-700">Para</th>
            <th class="px-4 py-2 font-semibold text-sm text-gray-700">Estado</th>
            <th class="px-4 py-2 font-semibold text-sm text-gray-700">Accion</th>
            <th class="px-4 py-2 font-semibold text-sm text-gray-700"></th>
            <th class="px-4 py-2 font-semibold text-sm text-gray-700"></th>


        </tr>
    </thead>  
@foreach($requestBook as $book)
        @foreach($books as $b)
            @if($book->book_id == $b->id)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $b->title }}</td>
                    <!--match user id with user table-->
                    @foreach($user as $us)
                        @if($book->from_user_id == $us->id)
                            <td class="px-4 py-2">{{ $us->name }}</td>
                        @endif
                    @endforeach
                    @foreach($user as $us)
                        @if($book->to_user_id == $us->id)
                            <td class="px-4 py-2">{{ $us->name }}</td>
                        @endif
                    @endforeach
                    <td class="px-4 py-2">{{ $book->status }}</td>
                    <td class="px-4 py-2">{{ $book->status }}</td>
                    <form action="{{ route('acceptSwap', $b->id) }}" method="POST">
                    @csrf
                   @method('PATCH')
                    <td class="px-4 py-2"><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Accept</button></td>
                    </form>

                    <td class="px-4 py-2"><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Declinar</button></td>
                </tr>
            @endif
        @endforeach
        @endforeach
</table>
</div>
</body>
</html>
