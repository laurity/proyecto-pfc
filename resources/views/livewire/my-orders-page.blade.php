<div class="flex flex-col min-h-screen">
  <div class="flex-grow">
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto mt-16">
      <h1 class="text-4xl font-bold text-black text-center pt-4">Mis Pedidos</h1>
      <div class="flex flex-col bg-white p-5 rounded mt-4 shadow-lg">
        <div class="-m-1.5 overflow-x-auto">
          <div class="p-1.5 min-w-full inline-block align-middle">
            <div class="overflow-hidden">
              @if($orders->isEmpty())
                <div class="text-center text-gray-500 py-5">
                  <p>No has realizado ningún pedido aún.</p>
                </div>
              @else
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                  <thead>
                    <tr>
                      <th scope="col" class="px-2 py-3 text-start text-xs font-medium text-gray-500 uppercase">Pedido</th>
                      <th scope="col" class="px-2 py-3 text-start text-xs font-medium text-gray-500 uppercase">Fecha</th>
                      <th scope="col" class="px-2 py-3 text-start text-xs font-medium text-gray-500 uppercase">Estado del Pedido</th>
                      <th scope="col" class="px-2 py-3 text-start text-xs font-medium text-gray-500 uppercase">Estado del Pago</th>
                      <th scope="col" class="px-2 py-3 text-start text-xs font-medium text-gray-500 uppercase">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($orders as $order)
                      @php
                        $status = '';
                        $payment_status = '';
                        if($order->status == 'new'){
                            $status = '<span class="bg-blue-500 py-1 px-3 rounded text-white shadow">Nuevo</span>';
                        }
                        if($order->status == 'processing'){
                            $status = '<span class="bg-yellow-500 py-1 px-3 rounded text-white shadow">En proceso</span>';
                        }
                        if($order->status == 'shipped'){
                            $status = '<span class="bg-green-500 py-1 px-3 rounded text-white shadow">Enviado</span>';
                        }
                        if($order->status == 'delivered'){
                            $status = '<span class="bg-green-500 py-1 px-3 rounded text-white shadow">Entregado</span>';
                        }
                        if($order->status == 'canceled'){
                            $status = '<span class="bg-red-500 py-1 px-3 rounded text-white shadow">Cancelado</span>';
                        }

                        if($order->payment_status == 'pending'){
                            $payment_status = '<span class="bg-blue-500 py-1 px-3 rounded text-white shadow">Pendiente</span>';
                        }
                        if($order->payment_status == 'paid'){
                            $payment_status = '<span class="bg-green-500 py-1 px-3 rounded text-white shadow">Pagado</span>';
                        }
                        if($order->payment_status == 'failed'){
                            $payment_status = '<span class="bg-red-500 py-1 px-3 rounded text-white shadow">Fallido</span>';
                        }
                      @endphp

                      <tr class="odd:bg-white even:bg-gray-100 dark:odd:bg-slate-900 dark:even:bg-slate-800" wire:key='{{ $order->id}}'>
                        <td class="px-2 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ $order->id }}</td>
                        <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{$order->created_at->format('d-m-Y')}}</td>
                        <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{!! $status !!}</td>
                        <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{!! $payment_status !!}</td>
                        <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ number_format($order->grand_total, 2, ',', '') . ' €' }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
