<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <section class="overflow-hidden bg-white py-11 font-poppins dark:bg-gray-800">
      <div class="max-w-6xl px-4 py-4 mx-auto lg:py-8 md:px-6">
          <div class="flex flex-wrap -mx-4">
              <div class="w-full mb-8 md:w-1/2 md:mb-0">
                  <div class="sticky top-0 z-30 overflow-hidden">
                      <div class="relative mb-6 lg:mb-10">
                          <img id="mainImage" src="{{ url('storage', $product->images[0]) }}" alt="" class="object-cover w-full h-full max-h-96 rounded-lg cursor-pointer" onclick="openModal()">
                      </div>
                      <div class="flex-wrap hidden md:flex">
                          @foreach ($product->images as $index => $image)
                          <div class="w-1/2 p-2 sm:w-1/4">
                              <img src="{{ url('storage', $image) }}" alt="{{ $product->name }}" class="object-cover w-full h-20 cursor-pointer hover:border hover:border-red-500 rounded-lg" onclick="changeImage('{{ url('storage', $image) }}', {{ $index }})">
                          </div>
                          @endforeach
                      </div>
                  </div>

                  <!-- Modal -->
                  <div id="modal" class="fixed inset-0 z-50 flex items-center justify-center w-full h-full bg-black bg-opacity-50 hidden" onclick="closeModal(event)">
                      <div class="relative w-11/12 max-w-3xl bg-white rounded-lg dark:bg-gray-800">
                          <button class="absolute top-0 right-0 mt-4 mr-4 text-gray-500 dark:text-gray-400" onclick="closeModal()">
                              <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                              </svg>
                          </button>
                          <div class="flex items-center justify-between p-4">
                              <button onclick="prevImage()" class="p-2">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                  </svg>
                              </button>
                              <div class="w-full max-w-3xl flex items-center justify-center">
                                  <img id="modalImage" src="{{ url('storage', $product->images[0]) }}" alt="{{ $product->name }}" class="object-contain w-full h-full max-h-screen rounded-lg">
                              </div>
                              <button onclick="nextImage()" class="p-2">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                  </svg>
                              </button>
                          </div>
                      </div>
                  </div>

              </div>
              <div class="w-full px-4 md:w-1/2">
                  <div class="lg:pl-20">
                      <div class="mb-8 [&>ul]:list-disc [&>ul]:ml-4">
                          <h2 class="max-w-xl mb-6 text-2xl font-bold dark:text-gray-400 md:text-4xl">{{ $product->name }}</h2>
                          <p class="inline-block mb-6 text-4xl font-bold text-gray-700 dark:text-gray-400"><span>{{ number_format($product->price, 2, ',', '') . ' €' }}</span></p>
                          <p class="max-w-md text-gray-700 dark:text-gray-400">{!! Str::markdown($product->description) !!}</p>
                      </div>
                      <div class="w-32 mb-8">
                          <label for="quantity" class="w-full pb-1 text-xl font-semibold text-gray-700 border-b border-red-300 dark:border-gray-600 dark:text-gray-400">Cantidad</label>
                          <div class="relative flex flex-row w-full h-10 mt-6 bg-transparent rounded-lg">
                              <button wire:click='decreaseQty' class="w-20 h-full text-gray-600 bg-gray-300 rounded-l outline-none cursor-pointer dark:hover:bg-gray-700 dark:text-gray-400 hover:text-gray-700 dark:bg-gray-900 hover:bg-gray-400">
                                  <span class="m-auto text-2xl font-thin">-</span>
                              </button>
                              <input type="number" id="quantity" wire:model='quantity' readonly class="flex items-center w-full font-semibold text-center text-gray-700 placeholder-gray-700 bg-gray-300 outline-none dark:text-gray-400 dark:placeholder-gray-400 dark:bg-gray-900 focus:outline-none text-md hover:text-black" placeholder="1">
                              <button wire:click='increaseQty' class="w-20 h-full text-gray-600 bg-gray-300 rounded-r outline-none cursor-pointer dark:hover:bg-gray-700 dark:text-gray-400 dark:bg-gray-900 hover:text-gray-700 hover:bg-gray-400">
                                  <span class="m-auto text-2xl font-thin">+</span>
                              </button>
                          </div>
                      </div>
                      <div class="flex flex-wrap items-center gap-4">
                          <button wire:click='addToCart({{ $product->id }})' class="w-full p-4 bg-red-500 rounded-md lg:w-2/5 dark:text-gray-200 text-gray-50 hover:bg-red-600 dark:bg-red-500 dark:hover:bg-red-700">
                              <span wire:loading.remove wire:target="addToCart({{ $product->id }})">Añadir al carrito</span><span wire:loading wire:target="addToCart({{ $product->id }})">Añadiendo...</span>
                          </button>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
</div>

<script>
  const images = {!! json_encode($product->images) !!};
  let currentIndex = 0;

  function changeImage(src, index) {
      document.getElementById('mainImage').src = src;
      currentIndex = index;
  }

  function openModal() {
      document.getElementById('modal').classList.remove('hidden');
      document.getElementById('modalImage').src = images[currentIndex] ? '{{ url('storage') }}/' + images[currentIndex] : '';
  }

  function closeModal(event) {
      if (!event || event.target.id === 'modal') {
          document.getElementById('modal').classList.add('hidden');
      }
  }

  function prevImage() {
      currentIndex = (currentIndex - 1 + images.length) % images.length;
      document.getElementById('modalImage').src = '{{ url('storage') }}/' + images[currentIndex];
  }

  function nextImage() {
      currentIndex = (currentIndex + 1) % images.length;
      document.getElementById('modalImage').src = '{{ url('storage') }}/' + images[currentIndex];
  }
</script>