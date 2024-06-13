<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DAWventures</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('../resources/css/app.css') }}">
</head>
<body> <!-- Clase para aplicar un fondo oscuro y texto blanco -->
<header class="bg-gray-800">
  <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
    <div class="flex lg:flex-1">
      <a href="#" class="-m-1.5 p-1.5">
        <span class="sr-only">Tu logo</span>
        <img class="h-12 w-auto" src="{{ asset('../storage/images/montana.png') }}" alt="">
      </a>
    </div>
    <div class="flex lg:hidden">
      <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-300"> <!-- Texto gris claro para icono del menú -->
        <span class="sr-only">Abrir menu principal</span>
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
      </button>
    </div>
    <div class="hidden lg:flex lg:gap-x-12">
      <a href="{{ route('main') }}" class="text-sm font-semibold leading-6 text-gray-300 hover:text-gray-300 hover:underline">Principal</a> <!-- Texto gris claro para los enlaces -->
      <a @if (!Auth::check()) href="{{ route('showLogin') }}" @else href="{{ route('showUpload') }}" @endif class="text-sm font-semibold leading-6 text-gray-300 hover:text-gray-300 hover:underline">Crear experiencia</a>
      <a @if (!Auth::check()) href="{{ route('showLogin') }}" @else href="{{ route('showProfile') }}" @endif class="text-sm font-semibold leading-6 text-gray-300 hover:text-gray-300 hover:underline">Perfil</a>
    </div>
    <div class="hidden lg:flex lg:flex-1 lg:justify-end">
      @if (!Auth::check())
        <a href="{{ route('showLogin') }}"><button class="ml-4 py-2 px-4 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Iniciar sesión</button></a>
        <a href="{{ route('showSignup') }}"><button class="ml-4 py-2 px-4 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Registrarse</button></a>
      @else
        <img class="h-10 w-10 rounded-full bg-gray-50 mr-3" src="../{{ Auth::user()->profile_image }}" alt="">
        <a href="{{ route('showProfile') }}" class="text-3xl mt-2 font-semibold leading-6 text-gray-300 hover:text-gray-300 hover:underline">{{ Auth::user()->name }}</a>
        <a href="{{ route('logout') }}"><button class="ml-4 py-2 px-4 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Cerrar sesión</button></a>
      @endif
    </div>
  </nav>
  <!-- Mobile menu, show/hide based on menu open state. -->
</header>

@yield('content')

</body>

<footer class="alm bg-gray-800 text-white py-8">
    <div class="container mx-auto flex justify-between items-center">
        <div class="flex space-x-4">
            <a href="https://github.com/AlejGom" class="flex items-center space-x-2">
                <span class="t">GitHub</span>
                <svg fill="currentColor" viewBox="0 0 24 24" class="h-5 w-5" aria-hidden="true">
                    <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path>
                </svg>
            </a>
            <a href="https://www.instagram.com/aleejandro_gp_02/" class="flex items-center space-x-2">
                <span class="t">Instagram</span>
                <svg fill="currentColor" viewBox="0 0 24 24" class="h-5 w-5" aria-hidden="true">
                    <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path>
                </svg>
            </a>
            <!-- more -->
        </div>
        <div class="text-sm">
            <p>© 2024 DAWventures, Inc. All rights reserved.</p>
        </div>
    </div>
</footer>
</html>
