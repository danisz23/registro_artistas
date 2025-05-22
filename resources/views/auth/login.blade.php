<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Museo Nacional de Arte</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body class="relative min-h-screen flex items-center justify-center">

    <!-- Fondo de imagen -->
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('/backgrounds/FB_IMG.jpg');"></div>

    <!-- Capa sombreada negra -->
    <div class="absolute inset-0 bg-black opacity-60"></div>

    <!-- Contenido -->
    <div class="relative z-10 w-full max-w-5xl mx-4 bg-white p-10 rounded-2xl shadow-2xl flex flex-col md:flex-row">
        <!-- Lado Izquierdo -->
        <div class="md:w-1/2 flex flex-col justify-center text-[#F0F0F0] pr-0 md:pr-6 border-b md:border-b-0 md:border-r border-[#333333] mb-8 md:mb-0 items-center md:items-start">
            <img src="/backgrounds/logo.jpg" alt="Logo" class="w-56 h-auto mb-14">
            <h2 class="text-4xl font-bold mb-4 text-center md:text-left">¡Bienvenido!</h2>
            <p class="text-sm text-center md:text-left">
                Accede al sistema de Registro de Artistas
            </p>
        </div>

        <!-- Lado Derecho -->
        <form method="POST" action="{{ route('login') }}" class="md:w-1/2 md:pl-6 flex flex-col justify-center space-y-6">
            @csrf

            <div>
                <label class="text-[#F0F0F0]" for="email">Correo electrónico</label>
                <div class="flex items-center border-b border-[#C9B29B] py-2">
                    <i class="fas fa-envelope text-[#C9B29B] mr-3"></i>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Ingrese su correo" class="bg-transparent outline-none w-full text-[#F0F0F0] placeholder-[#B6B6B6] @error('email') is-invalid @enderror">
                </div>
                @error('email')
                    <span class="invalid-feedback text-red-500 text-sm" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div>
                <label class="text-[#F0F0F0]" for="password">Contraseña</label>
                <div class="flex items-center border-b border-[#C9B29B] py-2">
                    <i class="fas fa-lock text-[#C9B29B] mr-3"></i>
                    <input type="password" id="password" name="password" required placeholder="Ingrese su contraseña" class="bg-transparent outline-none w-full text-[#F0F0F0] placeholder-[#B6B6B6] @error('password') is-invalid @enderror">
                </div>
                @error('password')
                    <span class="invalid-feedback text-red-500 text-sm" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Botón de login -->
            <button type="submit" class="mt-6 bg-black hover:bg-gray-800 transition text-white font-bold py-2 rounded-full">
                Ingresar
            </button>

            <!-- Enlace a la página de registro -->
            <div class="mt-4 text-center">
                <p class="text-sm text-[#F0F0F0]">
                    ¿No tienes cuenta? <a href="{{ route('register') }}" class="text-[#C9B29B] hover:text-[#A68C6D] underline">Regístrate aquí</a>
                </p>
            </div>
        </form>
    </div>

</body>
</html>
