<script src="https://unpkg.com/@tailwindcss/browser@4"></script>

<div class="min-h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('https://img.freepik.com/foto-gratis/biblioteca-libros_1063-98.jpg?t=st=1739629097~exp=1739632697~hmac=97fd1f99d3d23252dc9372b58fb7cdb94c5c5b04f4ff9f51e128f28b4c0a0a4b&w=996');">
    <div class="bg-white bg-opacity-90 p-8 rounded-lg shadow-lg max-w-md w-full">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">📚 Librería Online</h2>
        
        @if (session('status'))
            <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Correo electrónico</label>
                <input id="email" type="email" name="email" required autofocus
                    class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300">
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Contraseña</label>
                <input id="password" type="password" name="password" required
                    class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300">
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="form-checkbox">
                    <span class="ml-2 text-gray-600">Recordarme</span>
                </label>
                <a href="{{ route('password.request') }}" class="text-blue-500 hover:underline">¿Olvidaste tu contraseña?</a>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-blue-500 text-white p-3 rounded-lg hover:bg-blue-600 transition">
                Iniciar Sesión
            </button>
        </form>

        <!-- Register Link -->
        <p class="text-center text-gray-600 mt-4">
            ¿No tienes una cuenta? <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Regístrate</a>
        </p>
    </div>
</div>