<section class="font-poppins dark:bg-gray-800 mt-16">
  <div class="max-w-6xl mx-auto bg-white dark:bg-gray-900 p-6 md:p-10 rounded-md shadow-lg">
    <div class="text-center mb-8">
      <h1 class="text-2xl font-semibold text-gray-700 dark:text-gray-300">Gracias. Su pedido ha sido recibido.</h1>
    </div>
    <div class="border-b border-gray-200 dark:border-gray-700 pb-6 mb-8">
      <div class="flex justify-between items-center">
        <div class="flex-shrink-0">
          <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-400">{{ $order->address->full_name }}</h2>
          <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->address->street_address }}</p>
          <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->address->city }}, {{ $order->address->province }}, {{ $order->address->postal_code }}</p>
          <p class="text-sm text-gray-600 dark:text-gray-400">Teléfono: {{ $order->address->phone }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600 dark:text-gray-400">Número de pedido: <span class="font-semibold text-gray-800 dark:text-gray-400">{{ $order->id }}</span></p>
          <p class="text-sm text-gray-600 dark:text-gray-400">Fecha: <span class="font-semibold text-gray-800 dark:text-gray-400">{{ $order->created_at->format('d-m-Y') }}</span></p>
          <p class="text-sm text-gray-600 dark:text-gray-400">Total: <span class="font-semibold text-black-600 dark:text-gray-400">{{ number_format($order->grand_total, 2, ',', '.') }} €</span></p>
          <p class="text-sm text-gray-600 dark:text-gray-400">Método de pago: <span class="text-gray-800">{{$order->payment_method  == 'cod'? 'En Efectivo':'Tarjeta'}}</span></p>
        </div>
      </div>
    </div>
    <div class="border-b border-gray-200 dark:border-gray-700 pb-6 mb-8">
      <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-400 mb-4">Detalles del pedido</h2>
      <div class="space-y-4">
        <div class="flex justify-between">
          <p class="text-base text-gray-800 dark:text-gray-400">Subtotal</p>
          <p class="text-base text-gray-600 dark:text-gray-400">{{ number_format(0, 2, ',', '.') }} €</p>
        </div>
        <div class="flex justify-between">
          <p class="text-base text-gray-800 dark:text-gray-400">Descuento</p>
          <p class="text-base text-gray-600 dark:text-gray-400">{{ number_format(0, 2, ',', '.') }} €</p>
        </div>
        <div class="flex justify-between">
          <p class="text-base text-gray-800 dark:text-gray-400">Envío</p>
          <p class="text-base text-gray-600 dark:text-gray-400">{{ number_format(0, 2, ',', '.') }} €</p>
        </div>
        <div class="flex justify-between">
          <p class="text-base font-semibold text-gray-800 dark:text-gray-400">Total</p>
          <p class="text-base font-semibold text-gray-600 dark:text-gray-400">{{ number_format($order->grand_total, 2, ',', '.') }} €</p>
        </div>
      </div>
    </div>
    <div class="flex justify-between items-center">
      <div class="flex items-center space-x-4">
        <div class="w-8 h-8">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-6 h-6 text-red-600 dark:text-red-400 bi bi-truck" viewBox="0 0 16 16">
            <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"></path>
          </svg>
        </div>
        <div class="text-lg font-semibold text-gray-800 dark:text-gray-400">Entrega <br><span class="text-sm font-normal">Entrega en 24 horas</span></div>
      </div>
      <p class="text-lg font-semibold text-gray-800 dark:text-gray-400">{{ number_format(0, 2, ',', '.') }} €</p>
    </div>
    <div class="mt-6 flex gap-4">
      <a href="/products" class="flex-1 px-4 py-2 text-center text-red-500 border border-red-500 rounded-md hover:text-white hover:bg-red-600 dark:border-gray-700 dark:hover:bg-gray-700 dark:text-gray-300">
        Volver a comprar
      </a>
      <a href="/my-orders" class="flex-1 px-4 py-2 text-center bg-red-500 rounded-md text-gray-50 hover:bg-red-600 dark:hover:bg-gray-700 dark:bg-gray-800">
        Ver mis pedidos
      </a>
    </div>
  </div>
</section>
