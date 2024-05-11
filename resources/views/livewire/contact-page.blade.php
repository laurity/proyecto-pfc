<div>
    <section class="py-16">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-4">Contacto</h2>
            <p class="text-gray-700">¿Tienes alguna pregunta? ¡Escríbenos!</p>
            <form class="mt-8 max-w-2xl mx-auto" wire:submit.prevent="submitForm">
                <div class="flex flex-col md:flex-row md:justify-between">
                    <div class="mb-4 md:mr-4 md:w-1/2">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nombre</label>
                        <input type="text" id="name" name="name" wire:model="first_name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" required>
                        @error('first_name')
								<div class="text-red-500 text-sm">El nombre es requerido</div>
								@enderror
                    </div>
                    <div class="mb-4 md:ml-4 md:w-1/2">
                        <label for="surname" class="block text-gray-700 text-sm font-bold mb-2">Apellidos</label>
                        <input type="text" id="surname" name="surname" wire:model="last_name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" required>
                        @error('last_name')
                        <div class="text-red-500 text-sm">Los apellidos son requeridos</div>
                        @enderror
                    </div>
                </div>
                <div class="flex flex-col md:flex-row md:justify-between">
                    <div class="mb-4  w-full">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Correo electrónico</label>
                        <input type="email" id="email" name="email" wire:model="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" required>
                        @error('email')
                        <div class="text-red-500 text-sm">El correo electrónico es requerido</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-4">
                    <label for="message" class="block text-gray-700 text-sm font-bold mb-2">Mensaje</label>
                    <textarea id="message" name="message" wire:model="message" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" rows="4" required></textarea>
                    @error('message')
                    <div class="text-red-500 text-sm">Debe de incluir un mensaje</div>
                    @enderror
                </div>
                <button type="submit" class="w-full px-3 py-4 text-white bg-blue-500 rounded-md focus:bg-blue-600 focus:outline-none">Enviar mensaje</button>
            </form>
        </div>
    </section>
</div>
<script>
    window.addEventListener('submit', function (event) {
        event.preventDefault();
        alert('La información del formulario ha sido recogida. En breves nos pondremos en contacto contigo.');
    });
</script>