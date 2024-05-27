<?php

namespace Tests\Feature\Livewire\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use App\Livewire\Auth\RegisterPage;
use Tests\TestCase;

class RegisterPageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test028MuestraPaginaDeRegistro()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSeeLivewire('auth.register-page');
    }

    /** @test */
    public function test029RequiereNombreEmailYContraseña()
    {
        Livewire::test(RegisterPage::class)
            ->call('save')
            ->assertHasErrors(['name' => 'required', 'email' => 'required', 'password' => 'required']);
    }

    /** @test */
    public function test030CreaUsuarioEIniciaSesion()
    {
        Livewire::test(RegisterPage::class)
            ->set('name', 'Test User')
            ->set('email', 'test@example.com')
            ->set('password', 'Password1!')
            ->call('save')
            ->assertRedirect('/');

        $this->assertTrue(User::whereEmail('test@example.com')->exists());
        $this->assertAuthenticatedAs(User::whereEmail('test@example.com')->first());
    }
}