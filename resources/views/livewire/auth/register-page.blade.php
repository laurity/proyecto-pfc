<div class="container mx-auto py-10 px-4 sm:px-6 lg:px-8">
  <div class="flex justify-center items-center min-h-screen">
    <main class="w-full max-w-md p-6">
      <div class="bg-white border border-gray-300 rounded-lg shadow-lg">
        <div class="p-6">
          <div class="text-center">
            <h1 class="text-3xl font-bold text-black-800">Registrarse</h1>
            <p class="mt-2 text-sm text-gray-600">
              ¿Ya tienes una cuenta?
              <a class="text-black-500 hover:text-black-700 underline" href="/login">
                Inicia sesión aquí
              </a>
            </p>
          </div>
          <hr class="my-5">
          <form wire:submit.prevent='save'>
            <div class="space-y-4">
              <div>
                <label for="name" class="block text-sm mb-2">Nombre</label>
                <input type="text" id="name" wire:model="name" class="py-2 px-3 w-full border border-gray-300 rounded-lg focus:border-red-500 focus:ring-red-500" aria-describedby="name-error">
                @error('name')
                <p class="text-xs text-red-600 mt-2" id="name-error">El nombre es requerido</p>
                @enderror
              </div>
              <div>
                <label for="email" class="block text-sm mb-2">Correo Electrónico</label>
                <input type="email" id="email" wire:model="email" class="py-2 px-3 w-full border border-gray-300 rounded-lg focus:border-red-500 focus:ring-red-500" aria-describedby="email-error">
                @error('email')
                <p class="text-xs text-red-600 mt-2" id="email-error">Error en el correo electrónico</p>
                @enderror
              </div>
              <div>
                <div class="flex justify-between items-center">
                  <label for="password" class="block text-sm mb-2">Contraseña</label>
                </div>
                <p class="text-xs mb-1 text-gray-600">La contraseña debe tener más de 8 caracteres, contener al menos una mayúscula y un carácter especial.</p>
                <input type="password" id="password" wire:model="password" class="py-2 px-3 w-full border border-gray-300 rounded-lg focus:border-red-500 focus:ring-red-500" aria-describedby="password-error">
                @error('password')
                <p class="text-xs text-red-600 mt-2" id="password-error">Error en el correo electrónico</p>
                @enderror
              </div>
              <button type="submit" class="w-full py-2 px-4 text-sm font-semibold rounded-lg border border-transparent bg-red-500 text-white hover:bg-red-600">Registrarse</button>
            </div>
          </form>
        </div>
      </div>
  </div>
</div>
