<?php

namespace Tests\Feature\Livewire;

use Tests\TestCase;
use App\Livewire\ContactPage;
use Livewire\Livewire;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactPageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test010PuedeEnviarElFormularioDeContacto()
    {
        Livewire::test(ContactPage::class)
            ->set('first_name', 'John')
            ->set('last_name', 'Doe')
            ->set('email', 'john.doe@example.com')
            ->set('message', 'This is a test message.')
            ->call('submitForm')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('contacts', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.',
        ]);
    }

    /** @test */
    public function test011RequiereTodosLosCamposRellenos()
    {
        Livewire::test(ContactPage::class)
            ->set('first_name', '')
            ->set('last_name', '')
            ->set('email', '')
            ->set('message', '')
            ->call('submitForm')
            ->assertHasErrors(['first_name', 'last_name', 'email', 'message']);
    }

    /** @test */
    public function test012RequiereUnCorreoElectronicoValido()
    {
        Livewire::test(ContactPage::class)
            ->set('first_name', 'John')
            ->set('last_name', 'Doe')
            ->set('email', 'not-an-email')
            ->set('message', 'This is a test message.')
            ->call('submitForm')
            ->assertHasErrors(['email']);
    }
}
