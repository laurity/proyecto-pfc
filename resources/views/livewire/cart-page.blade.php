<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <div class="container mx-auto px-4">
    <h1 class="mt-16 text-3xl font-bold mb-6 text-center text-black-800">Carrito de Compras</h1>
      <div class="flex flex-col md:flex-row gap-6">
          <div class=" md:w-11/12">
              <div class="bg-white overflow-x-auto rounded-lg shadow-lg p-8 mb-6">
                  <table class="w-full border-collapse text">
                      <thead>
                          <tr>
                              <th class="text-center font-bold p-4 text-black-800">Producto</th>
                              <th class="text-center font-bold p-4 text-black-800">Precio</th>
                              <th class="text-center font-bold p-4 text-black-800">Cantidad</th>
                              <th class="text-center font-bold p-4 text-black-800">Total</th>
                              <th class="text-center font-bold p-4 text-black-800">Eliminar</th>
                          </tr>
                      </thead>
                      <tbody>
                          @forelse ($cart_items as $item)
                          <tr wire:key="{{ $item['product_id'] }}" class="border-b">
                              <td class="py-4 px-4">
                                  <div class="flex items-center">
                                      <img class="h-16 w-16 rounded mr-4" src="{{ url('storage', $item['image']) }}" alt="{{ $item['name'] }}">
                                      <span class="font-medium">{{ $item['name'] }}</span>
                                  </div>
                              </td>
                              <td class="py-4 px-4">{{ number_format($item['unit_amount'], 2, ',', '') . ' €' }}</td>
                              <td class="py-4 px-4">
                                  <div class="flex items-center">
                                      <button wire:click="decreaseQty({{ $item['product_id'] }})" class="border rounded-full py-1 px-3 mr-2 bg-gray-200">-</button>
                                      <span class="text-center w-8">{{ $item['quantity'] }}</span>
                                      <button wire:click="increaseQty({{ $item['product_id'] }})" class="border rounded-full py-1 px-3 ml-2 bg-gray-200">+</button>
                                  </div>
                              </td>
                              <td class="py-4 px-4">{{ number_format($item['total_amount'], 2, ',', '') . ' €' }}</td>
                              <td class="py-4 px-4"><button wire:click="removeItem({{ $item['product_id'] }})" class="text-red-600 hover:text-red-800">Eliminar</button></td>
                          </tr>
                          @empty
                          <tr>
                              <td colspan="5" class="text-center py-6 text-2xl font-medium text-gray-500">Carrito vacío</td>
                          </tr>
                          @endforelse
                      </tbody>
                  </table>
              </div>
          </div>
          <div class="md:w-1/4">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-xl font-semibold mb-4 text-black-800">Resumen del Pedido</h2>
                  <div class="flex justify-between mb-4">
                      <span class="text-gray-600">Subtotal</span>
                      <span>{{ number_format($grand_total, 2, ',', '') . ' €' }}</span>
                  </div>
                  <div class="flex justify-between mb-4">
                      <span class="text-gray-600">Impuesto</span>
                      <span>{{ number_format(0, 2, ',', '') . ' €' }}</span>
                  </div>
                  <div class="flex justify-between mb-4">
                      <span class="text-gray-600">Envío</span>
                      <span>{{ number_format(0, 2, ',', '') . ' €' }}</span>
                  </div>
                  <hr class="my-4">
                  <div class="flex justify-between mb-4">
                      <span class="text-xl font-semibold text-gray-800">Total</span>
                      <span class="text-xl font-semibold text-gray-800">{{ number_format($grand_total, 2, ',', '') . ' €' }}</span>
                  </div>
                  @if ($cart_items)
                  <a href="/checkout" class="bg-red-600 text-white text-center py-3 px-4 rounded-lg block">Pagar</a>
                  @endif
              </div>
          </div>
      </div>
  </div>
</div>
