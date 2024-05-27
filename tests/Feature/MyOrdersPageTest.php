<?php
namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class MyOrdersPageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test014MostrarPedidosDeUsuario()
    {
        $user = User::factory()->create();
        $order1 = Order::factory()->create(['user_id' => $user->id]);
        $order2 = Order::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);

        Livewire::test('App\Livewire\MyOrdersPage')
            ->call('renderizarMisPedidos')
            ->assertSee($order1->id)
            ->assertSee($order2->id)
            ->assertSee($order1->created_at->format('d-m-Y'))
            ->assertSee($order2->created_at->format('d-m-Y'));
    }
}
