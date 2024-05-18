<header class="fixed top-0 left-0 z-50 w-full bg-red-800 shadow-md">
  <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center py-4 md:space-x-10">
          <div class="flex justify-start lg:w-0 lg:flex-1">
              <a href="/" class="text-xl font-semibold text-white">Alonso del Rey</a>
          </div>
          <div class="-mr-2 -my-2 md:hidden">
              <button type="button" class="bg-red-800 p-2 rounded-md text-white hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" id="mobile-menu-button">
                  <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                  </svg>
              </button>
          </div>
          <div class="hidden md:flex items-center justify-end md:flex-1 lg:w-0">
              <a href="/" class="text-base font-medium {{ request()->is('/') ? 'text-yellow-300' : 'text-white' }} hover:text-gray-200">Inicio</a>
              <a href="/categories" class="ml-8 text-base font-medium {{ request()->is('categories') ? 'text-yellow-300' : 'text-white' }} hover:text-gray-200">Categorías</a>
              <a href="/products" class="ml-8 text-base font-medium {{ request()->is('products') ? 'text-yellow-300' : 'text-white' }} hover:text-gray-200">Productos</a>
              <a href="/contact" class="ml-8 text-base font-medium {{ request()->is('contact') ? 'text-yellow-300' : 'text-white' }} hover:text-gray-200">Contacto</a>
              <a href="/cart" class="ml-8 flex items-center text-base font-medium {{ request()->is('cart') ? 'text-yellow-300' : 'text-white' }} hover:text-gray-200">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l1.4-8H6.6L7 13zM7 13a4 4 0 100 8 4 4 0 000-8zm10 0a4 4 0 100 8 4 4 0 000-8z" />
                  </svg>
                  <span>Carrito</span>
                  <span class="ml-2 py-0.5 px-2.5 rounded-full text-xs font-medium bg-yellow-300 text-yellow-900">{{$total_count}}</span>
              </a>
              @guest
              <a href="/login" class="ml-8 py-2 px-4 inline-flex items-center justify-center text-sm font-medium rounded-md bg-white text-red-800 hover:bg-gray-200 focus:ring-red-600 whitespace-nowrap">Iniciar sesión</a>
              @endguest
              @auth
              <div class="ml-8 relative">
                  <button type="button" class="text-white hover:text-gray-200 flex items-center focus:outline-none" id="user-menu-button">
                      {{ auth()->user()->name }}
                      <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                      </svg>
                  </button>
                  <div class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-red-700 ring-1 ring-black ring-opacity-5 hidden" id="user-menu">
                      <a href="/my-orders" class="block px-4 py-2 text-sm text-white hover:bg-red-800">Mis pedidos</a>
                      <a href="/logout" class="block px-4 py-2 text-sm text-white hover:bg-red-800">Cerrar sesión</a>
                  </div>
              </div>
              @endauth
          </div>
      </div>
  </nav>
  <div class="md:hidden hidden" id="mobile-menu">
      <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
          <a href="/" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-red-700">Inicio</a>
          <a href="/categories" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-red-700">Categorías</a>
          <a href="/products" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-red-700">Productos</a>
          <a href="/contact" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-red-700">Contacto</a>
          <a href="/cart" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-red-700 flex items-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l1.4-8H6.6L7 13zM7 13a4 4 0 100 8 4 4 0 000-8zm10 0a4 4 0 100 8 4 4 0 000-8z" />
              </svg>
              Carrito
              <span class="ml-2 py-0.5 px-2.5 rounded-full text-xs font-medium bg-yellow-300 text-yellow-900">{{$total_count}}</span>
          </a>
          @guest
          <a href="/login" class="block w-full px-4 py-2 text-center font-medium text-white bg-gray-800 rounded-md hover:bg-gray-900 whitespace-nowrap">Iniciar sesión</a>
          @endguest
      </div>
  </div>
</header>

<script>
  document.getElementById('mobile-menu-button').onclick = function () {
      const menu = document.getElementById('mobile-menu');
      menu.classList.toggle('hidden');
  };

  document.getElementById('user-menu-button').onclick = function () {
      const menu = document.getElementById('user-menu');
      menu.classList.toggle('hidden');
  };
</script>
