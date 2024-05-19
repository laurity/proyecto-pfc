<?php

namespace App\Livewire;

use App\Models\Contact;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Contacto')]

class ContactPage extends Component
{

    public $first_name;
    public $last_name;
    public $email;
    public $message;

    public function submitForm(){
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $contact = new Contact();
        $contact->first_name = $this->first_name;
        $contact->last_name = $this->last_name;
        $contact->email = $this->email;
        $contact->message = $this->message;
        $contact->save();

        $this->reset(['first_name', 'last_name', 'email', 'message']);    }
    public function render()
    {
        return view('livewire.contact-page');
    }
}
