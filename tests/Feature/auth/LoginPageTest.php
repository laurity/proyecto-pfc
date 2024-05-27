<?php

namespace Tests\Feature\Livewire\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use App\Livewire\Auth\LoginPage;
use Tests\TestCase;

class LoginPageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test024MuestraPaginaDeInicio()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSeeLivewire('auth.login-page');
    }

    /** @test */
    public function test025RequiereEmailYContraseña()
    {
        Livewire::test(LoginPage::class)
            ->call('save')
            ->assertHasErrors(['email' => 'required', 'password' => 'required']);
    }

    /** @test */
    public function test026VerificaCredencialesDeUsuarioEIniciaSesion()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        Livewire::test(LoginPage::class)
            ->set('email', 'test@example.com')
            ->set('password', 'password')
            ->call('save')
            ->assertRedirect('/');

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function test027MuestraMensajeDeErrorCuandoLasCredencialesSonInvalidas()
    {
        Livewire::test(LoginPage::class)
            ->set('email', 'test@example.com')
            ->set('password', 'invalid-password')
            ->call('save')
            ->assertHasErrors('email');

        $this->assertGuest();
    }
}