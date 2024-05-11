<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  <title>Tu Peluquería</title>
</head>
<body>
  <div class=" bg-white ">
    <section class="h-screen flex items-center justify-center">
      <div class="container mx-auto text-center">
        <img src="{{url('storage', 'inicio.webp')}}" alt="Peluquería" class="w-full h-auto">
        <a href="#about" class="mt-4 inline-block px-4 py-2 bg-blue-500 text-white font-bold rounded">Sobre nosotros</a>
      </div>
    </section>
    <section class="py-16 ">
      <div class="flex flex-col md:flex-row items-center justify-center p-10 bg-red-200">
        <img src="{{url('storage', 'wella-inicio.jpg')}}" alt="Productos" class=" w-64 h-64 md:mr-8 mb-4 md:mb-0">
        <div class="text-center md:text-left w-full md:w-3/4" >
          <span class="text-2xl text-gray-600">¿Por qué elegirnos?</span>
          <h2 class="text-3xl font-bold mb-4 text-red-600">Sobre nuestros productos</h2>
          <p>Estamos encantadas de ofrecerte lo mejor del mundo de la peluquería, con marcas líderes como L'Oréal, Wella y Schwarzkopf. En nuestro salón, fusionamos nuestra experiencia con las últimas tendencias para brindarte servicios de coloración, cortes y estilos para novias que destacan. Descubre tratamientos de vanguardia y técnicas exclusivas que harán que te veas y te sientas increíble. ¡Vente con nosotras para transformar tu estilo hoy mismo!</p>
        </div>
      </div>
    </section>
    <section class="py-16">
      <div class="container mx-auto text-center">
        <h2 class="text-3xl font-bold mb-4">Sobre nosotras</h2>
        <p class="text-gray-700"> </p>
        
        
      </div>
    </section>
    <section id="about" class="py-16">
      <div class="container mx-auto text-center">
        <h2 class="text-3xl font-bold mb-4">Horarios</h2>
        <p class="text-gray-700">Aquí puedes encontrar nuestros horarios de atención.</p>
        <!-- Agrega aquí el contenido de los horarios -->
      </div>
    </section>
  </div>
  <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>