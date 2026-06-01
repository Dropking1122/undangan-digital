<?php
namespace App\Livewire\Auth;
use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ForgotPassword extends Component
{
    public string $email = '';
    public bool $sent = false;

    protected $rules = ['email' => 'required|email'];

    public function send(): void
    {
        $this->validate();
        Password::sendResetLink(['email' => $this->email]);
        $this->sent = true;
    }

    public function render() { return view('livewire.auth.forgot-password')->layout('layouts.guest'); }
}
