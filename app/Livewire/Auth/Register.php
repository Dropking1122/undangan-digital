<?php
namespace App\Livewire\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Register extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
    ];

    public function register(): void
    {
        $this->validate();
        $user = User::create(['name'=>$this->name,'email'=>$this->email,'password'=>$this->password]);
        Auth::login($user);
        session()->regenerate();
        $this->redirect(route('dashboard'), navigate: true);
    }

    public function render() { return view('livewire.auth.register')->layout('layouts.guest'); }
}
