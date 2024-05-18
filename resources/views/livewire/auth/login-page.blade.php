<div class="container mx-auto py-10 px-4 sm:px-6 lg:px-8">
  <div class="flex justify-center items-center min-h-screen">
    <main class="w-full max-w-md p-6">
      <div class="bg-white border border-gray-300 rounded-lg shadow-lg">
        <div class="p-6">
          <div class="text-center">
            <h1 class="text-3xl font-bold text-black-800">Iniciar sesión</h1>
            <p class="mt-2 text-sm text-gray-600">
              ¿No tienes una cuenta aún?
              <a class="text-black-500 hover:text-black-700 underline" href="/register">
                Regístrate aquí
              </a>
            </p>
          </div>

          <hr class="my-5">

          <!-- Form -->
          <form wire:submit.prevent='save'>
            @if (session('error'))
            <div class="mt-2 bg-red-500 text-sm text-white rounded-lg p-4 mb-4" role="alert">
              {{ session('error') }}
            </div>
            @endif
            <div class="space-y-4">
              <!-- Form Group -->
              <div>
                <label for="email" class="block text-sm mb-2">Correo electrónico</label>
                <input type="email" id="email" wire:model="email" class="py-2 px-3 w-full border border-gray-300 rounded-lg focus:border-red-500 focus:ring-red-500" aria-describedby="email-error">
                @error('email')
                <p class="text-xs text-red-600 mt-2" id="email-error">Inserta un correo electrónico válido</p>
                @enderror
              </div>
              <!-- End Form Group -->

              <!-- Form Group -->
              <div>
                <div class="flex justify-between items-center">
                  <label for="password" class="block text-sm mb-2">Contraseña</label>
                  <a class="text-sm text-black-500 hover:text-black-700 underline" href="/forgot">¿Olvidaste tu contraseña?</a>
                </div>
                <input type="password" id="password" wire:model="password" class="py-2 px-3 w-full border border-gray-300 rounded-lg focus:border-red-500 focus:ring-red-500" aria-describedby="password-error">
                @error('password')
                <p class="text-xs text-red-600 mt-2" id="password-error">Inserta una contraseña válida</p>
                @enderror
              </div>
              <!-- End Form Group -->
              <button type="submit" class="w-full py-2 px-4 text-sm font-semibold rounded-lg border border-transparent bg-red-500 text-white hover:bg-red-600">Iniciar sesión</button>
            </div>
          </form>
          <!-- End Form -->
        </div>
      </div>
  </div>
</div>