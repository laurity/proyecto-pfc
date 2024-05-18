<div>
    <section class="py-16 bg-gray-100">
        <div class="w-full h-80 mb-8">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6879.61329276776!2d-5.659269802912577!3d43.533178847862914!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd367c80bb4e5f35%3A0x19836e5329c18c78!2sAlonso%20del%20Rey%20Estilistas!5e0!3m2!1ses!2ses!4v1716021462846!5m2!1ses!2ses" class="w-full h-full rounded-lg shadow-lg" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="container mx-auto text-center md:text-left">
            <div class="bg-white p-8 rounded-lg shadow-xl flex flex-col-reverse md:flex-row">
                <div class="mt-8 md:mt-0 md:mr-10 flex flex-col items-center justify-center text-center border-t-2 md:border-t-0 md:border-r-2 border-gray-300 pt-4 md:pt-0 md:pr-4">
                    <h3 class="text-2xl font-bold mb-4 text-red-900">Información de contacto</h3>
                    <p class="text-gray-700 mb-4">
                        <strong>Teléfono:</strong> 984 299 051
                    </p>
                    <p class="text-gray-700 mb-4">
                        <strong>Dirección:</strong> C. Alarcón, 35, Gijon-Este, 33204 Gijón, Asturias
                    </p>
                    <p class="text-gray-700 mb-4">
                        <strong>Horarios:</strong>
                        <ul>
                            <li><strong>Sábado:</strong> 9:00–13:30</li>
                            <li><strong>Domingo:</strong> Cerrado</li>
                            <li><strong>Lunes:</strong> Cerrado</li>
                            <li><strong>Martes:</strong> 10:00–16:00</li>
                            <li><strong>Miércoles:</strong> 10:00–16:00</li>
                            <li><strong>Jueves:</strong> 10:00–16:00</li>
                            <li><strong>Viernes:</strong> 9:30–18:00</li>
                        </ul>
                    </p>

                    <div class="flex justify-center mt-4">
                        <a class="w-10 h-10 inline-flex justify-center items-center text-red-700 hover:text-red-600 mr-4" href="#">
                            <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                            </svg>
                        </a>
                        <a class="w-10 h-10 inline-flex justify-center items-center text-red-700 hover:text-red-600" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="30" height="30" viewBox="0 0 50 50">
                                <path d="M 16 3 C 8.83 3 3 8.83 3 16 L 3 34 C 3 41.17 8.83 47 16 47 L 34 47 C 41.17 47 47 41.17 47 34 L 47 16 C 47 8.83 41.17 3 34 3 L 16 3 z M 37 11 C 38.1 11 39 11.9 39 13 C 39 14.1 38.1 15 37 15 C 35.9 15 35 14.1 35 13 C 35 11.9 35.9 11 37 11 z M 25 14 C 31.07 14 36 18.93 36 25 C 36 31.07 31.07 36 25 36 C 18.93 36 14 31.07 14 25 C 14 18.93 18.93 14 25 14 z M 25 16 C 20.04 16 16 20.04 16 25 C 16 29.96 20.04 34 25 34 C 29.96 34 34 29.96 34 25 C 34 20.04 29.96 16 25 16 z"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                <form class="w-full md:w-2/3" wire:submit.prevent="submitForm">
                    <h2 class="text-3xl font-bold mb-6 text-center text-red-900">Contacta con nosotros</h2>
                    <p class="text-gray-700 mb-8 text-center">¿Tienes alguna pregunta? ¡Escríbenos!</p>
                    <div class="flex flex-col md:flex-row md:justify-between">
                        <div class="mb-4 md:mr-4 md:w-1/2">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nombre</label>
                            <input type="text" id="name" name="name" wire:model="first_name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-red-500" required>
                            @error('first_name')
                            <div class="text-red-500 text-sm">El nombre es requerido</div>
                            @enderror
                        </div>
                        <div class="mb-4 md:ml-4 md:w-1/2">
                            <label for="surname" class="block text-gray-700 text-sm font-bold mb-2">Apellidos</label>
                            <input type="text" id="surname" name="surname" wire:model="last_name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-red-500" required>
                            @error('last_name')
                            <div class="text-red-500 text-sm">Los apellidos son requeridos</div>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row md:justify-between">
                        <div class="mb-4 w-full">
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Correo electrónico</label>
                            <input type="email" id="email" name="email" wire:model="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-red-500" required>
                            @error('email')
                            <div class="text-red-500 text-sm">El correo electrónico es requerido</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="message" class="block text-gray-700 text-sm font-bold mb-2">Mensaje</label>
                        <textarea id="message" name="message" wire:model="message" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-red-500" rows="4" required></textarea>
                        @error('message')
                        <div class="text-red-500 text-sm">Debe de incluir un mensaje</div>
                        @enderror
                    </div>
                    <button type="submit" class="w-full px-3 py-4 text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:bg-red-700">Enviar mensaje</button>
                </form>
            </div>
        </div>
    </section>
</div>
<script>
    window.addEventListener('submit', function (event) {
        event.preventDefault();
        alert('La información del formulario ha sido recogida. En breves nos pondremos en contacto contigo.');
    });
</script>
