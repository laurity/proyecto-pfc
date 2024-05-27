<?php


namespace Tests\Feature\Livewire;

use App\Livewire\SuccessPage;
use App\Models\Address;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SuccessPageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test023RenderizaCorrectamenteLaPaginaDeExito()
    {
        // Crear un usuario
        $user = User::factory()->create();

        // Simular la dirección
        $address = Address::factory()->create([
            'user_id' => $user->id,
            'full_name' => 'John Doe',
            'street_address' => '123 Main St',
            'city' => 'Madrid',
            'province' => 'Madrid',
            'postal_code' => '28001',
            'phone' => '123456789',
        ]);

        // Simular el pedido
        $order = Order::factory()->create([
            'user_id' => $user->id,
            'address_id' => $address->id,
            'grand_total' => 100.50,
            'payment_method' => 'card',
            'created_at' => now(),
        ]);

        // Actuar como el usuario
        $this->actingAs($user);

        // Renderizar el componente
        Livewire::test(SuccessPage::class)
            ->assertSee('Gracias. Su pedido ha sido recibido.')
            ->assertSee($order->address->full_name)
            ->assertSee($order->address->street_address)
            ->assertSee($order->address->city)
            ->assertSee($order->address->province)
            ->assertSee($order->address->postal_code)
            ->assertSee($order->address->phone)
            ->assertSee($order->id)
            ->assertSee($order->created_at->format('d-m-Y'))
            ->assertSee(number_format($order->grand_total, 2, ',', '.') . ' €')
            ->assertSee($order->payment_method == 'cod' ? 'En Efectivo' : 'Tarjeta');
    }
}

