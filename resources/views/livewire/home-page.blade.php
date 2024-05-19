<body>
  <div>
    <!-- Sección de Presentación -->
    <section id="presentacion" style="background: url('{{ asset('storage/nosotros.jpg') }}') center/cover; height: 100vh;">
      <div class="flex items-center justify-center h-full bg-black bg-opacity-60">
        <div class="text-center text-white p-4">
          <h1 class="text-6xl font-bold mb-4 font-bodoni">Alonso del Rey Estilistas</h1>
          <p class="text-2xl font-didot">Transformamos tu look, realzamos tu belleza</p>
        </div>
      </div>
    </section>

    <!-- Sección Sobre Nosotros -->
    <section id="sobre-nosotros" class="bg-orange-100 py-16">
      <div class="container mx-auto px-12 flex flex-col md:flex-row items-center">
        <div class="md:w-1/2 lg:pr-10">
          <h2 class="text-3xl font-bold mb-4 font-bodoni">Sobre Nosotros</h2>
          <p class="text-lg text-gray-700 mb-6 font-didot">Con más de 10 años de experiencia en el sector de la peluquería en Gijón, Alonso del Rey ha evolucionado constantemente desde sus inicios. Nos hemos comprometido a formarnos y aprender de la mano de los mejores salones y marcas, asegurándonos de estar siempre a la vanguardia con las técnicas más innovadoras y avanzadas del momento. En Alonso del Rey, nuestro objetivo es combinar la experiencia con las últimas tendencias para transformar y realzar la belleza de cada cliente.</p>
          <span class="underline font-didot">¿Tienes alguna duda?</span><br>
          <a href="{{ route('contact') }}" class="inline-block bg-red-800 text-white rounded-lg px-6 py-2 mt-4 font-didot">¡Contacta con nosotros!</a>
        </div>
        <div class="md:w-1/2 lg:w-5/12 mt-8 md:mt-0">
          <img src="{{ asset('storage/sobre_nosotros.jpg') }}" alt="Sobre Nosotros" class="rounded-lg shadow-lg">
        </div>
      </div>
    </section>

    <!-- Sección de Productos -->
    <section id="productos" class="py-16 bg-white">
      <div class="container mx-auto px-12 flex flex-col md:flex-row-reverse items-center">
        <div class="md:w-1/2 lg:pl-10">
          <h2 class="text-3xl font-bold mb-4 font-bodoni">Nuestros Productos</h2>
          <p class="text-lg text-gray-700 mb-6 font-didot">En Alonso del Rey, solo trabajamos con las mejores marcas del mercado, como Wella, Schwarzkopf y Kérastase, garantizando productos de alta calidad para nuestros clientes. Somos un salón de peluquería líder en Gijón, reconocido por nuestra innovación y vasta experiencia en el sector. Nos especializamos en ofrecer las últimas tendencias en coloraciones, cortes de pelo vanguardistas, estilos exclusivos para novias y tratamientos especializados como el aclamado tratamiento Olaplex y nuestro exclusivo alisado de keratina orgánica. Ven y experimenta un servicio excepcional donde la calidad y la atención personalizada son nuestra prioridad.</p>
          <a href="{{ route('products') }}" class="inline-block bg-red-800 text-white rounded-lg px-6 py-2 mt-4 font-didot">Nuestros productos</a>
        </div>
        <div class="md:w-1/2 lg:w-5/12 mt-8 md:mt-0">
          <img src="{{ asset('storage/nuestros_productos.jpg') }}" alt="Nuestros Productos" class="rounded-lg shadow-lg">
        </div>
      </div>
    </section>

    <!-- Sección de Servicios -->
    <section id="servicios" class="py-20 bg-orange-100">
      <div class="container mx-auto px-8">
        <h2 class="text-4xl font-bold text-center text-black mb-10 font-bodoni">Nuestros Servicios</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
          <div class="bg-white p-10 rounded-lg shadow-xl transition transform hover:scale-105">
            <div class="aspect-w-2 aspect-h-3">
              <img src="{{ asset('storage/corte.jpg') }}" alt="Corte de Pelo" class="w-full h-64 object-cover mb-5 rounded-lg open-modal" data-src="{{ asset('storage/corte.jpg') }}">
            </div>
            <h3 class="text-2xl font-bold text-black mb-5 font-bodoni">Corte de Pelo</h3>
            <p class="text-lg text-gray-700 font-didot">Ofrecemos cortes de pelo modernos y clásicos para cualquiera que desee un cambio de look. Nuestro equipo se asegura de que salgas con el estilo que deseas.</p>
          </div>
          <div class="bg-white p-10 rounded-lg shadow-xl transition transform hover:scale-105">
            <div class="aspect-w-2 aspect-h-3">
              <img src="{{ asset('storage/coloracionjpg.jpg') }}" alt="Coloración" class="w-full h-64 object-cover mb-5 rounded-lg open-modal" data-src="{{ asset('storage/coloracionjpg.jpg') }}">
            </div>
            <h3 class="text-2xl font-bold text-black mb-5 font-bodoni">Coloración</h3>
            <p class="text-lg text-gray-700 font-didot">Desde tintes completos hasta mechas, nuestras peluqueras son expertas en coloración y te ayudarán a encontrar el tono perfecto para tu cabello.</p>
          </div>
          <div class="bg-white p-10 rounded-lg shadow-xl transition transform hover:scale-105">
            <div class="aspect-w-2 aspect-h-3">
              <img src="{{ asset('storage/peinadosn.jpg') }}" alt="Peinados" class="w-full h-64 object-cover mb-5 rounded-lg open-modal" data-src="{{ asset('storage/peinadosn.jpg') }}">
            </div>
            <h3 class="text-2xl font-bold text-black mb-5 font-bodoni">Peinados</h3>
            <p class="text-lg text-gray-700 font-didot">Para ocasiones especiales o para el día a día, nuestras estilistas crean peinados únicos y personalizados que te harán sentir fabulosa.</p>
          </div>
          <div class="bg-white p-10 rounded-lg shadow-xl transition transform hover:scale-105">
            <div class="aspect-w-2 aspect-h-3">
              <img src="{{ asset('storage/peinados.jpg') }}" alt="Peinados para Novias" class="w-full h-64 object-cover mb-5 rounded-lg open-modal" data-src="{{ asset('storage/peinados.jpg') }}">
            </div>
            <h3 class="text-2xl font-bold text-black mb-5 font-bodoni">Peinados para Novias</h3>
            <p class="text-lg text-gray-700 font-didot">Ofrecemos una variedad de estilos de peinados para novias, diseñados para complementar tu belleza en tu día especial.</p>
          </div>
          <div class="bg-white p-10 rounded-lg shadow-xl transition transform hover:scale-105">
            <div class="aspect-w-2 aspect-h-3">
              <img src="{{ asset('storage/tratamientos.jpg') }}" alt="Tratamientos Capilares" class="w-full h-64 object-cover mb-5 rounded-lg open-modal" data-src="{{ asset('storage/tratamientos.jpg') }}">
            </div>
            <h3 class="text-2xl font-bold text-black mb-5 font-bodoni">Tratamientos Capilares</h3>
            <p class="text-lg text-gray-700 font-didot">Nuestros tratamientos capilares están diseñados para nutrir y revitalizar tu cabello, dejándolo saludable y brillante.</p>
          </div>
          <div class="bg-white p-10 rounded-lg shadow-xl transition transform hover:scale-105">
            <div class="aspect-w-2 aspect-h-3">
              <img src="{{ asset('storage/maquillaje.jpg') }}" alt="Maquillaje" class="w-full h-64 object-cover mb-5 rounded-lg open-modal" data-src="{{ asset('storage/maquillaje.jpg') }}">
            </div>
            <h3 class="text-2xl font-bold text-black mb-5 font-bodoni">Maquillaje</h3>
            <p class="text-lg text-gray-700 font-didot">Ya sea para un evento especial, una sesión de fotos o simplemente porque sí, nuestras expertas en maquillaje te ayudarán a lograr el look perfecto.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Modal -->
    <div id="imageModal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center hidden z-50 transition-opacity duration-300">
      <div class="bg-white p-4 rounded-lg shadow-lg relative max-w-md w-full mx-auto transition-transform transform scale-75 duration-300">
        <button id="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
        <img id="modalImage" src="" alt="Modal Image" class="w-full h-auto rounded-lg">
      </div>
    </div>
  </div>

  <!-- JavaScript -->
  <script>
    const openModalButtons = document.querySelectorAll('.open-modal');
    const modal = document.getElementById('imageModal');
    const closeModalButton = document.getElementById('closeModal');
    const modalImage = document.getElementById('modalImage');

    openModalButtons.forEach(button => {
      button.addEventListener('click', event => {
        const imgSrc = event.target.getAttribute('data-src');
        modalImage.src = imgSrc;
        modal.classList.remove('hidden');
        setTimeout(() => {
          modal.classList.remove('opacity-0');
          modal.classList.add('opacity-100');
          modal.querySelector('.transform').classList.remove('scale-75');
          modal.querySelector('.transform').classList.add('scale-100');
        }, 10);
      });
    });

    const closeModal = () => {
      modal.querySelector('.transform').classList.remove('scale-100');
      modal.querySelector('.transform').classList.add('scale-75');
      modal.classList.remove('opacity-100');
      modal.classList.add('opacity-0');
      setTimeout(() => {
        modal.classList.add('hidden');
      }, 300);
    };

    closeModalButton.addEventListener('click', closeModal);

    modal.addEventListener('click', (event) => {
      if (event.target === modal) {
        closeModal();
      }
    });
  </script>
</body>
