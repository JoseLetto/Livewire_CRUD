<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Logout extends Component
{

    
    public function logout()
    {
        Auth::logout();
        
        Session::invalidate();
        Session::regenerateToken();
        
        return $this->redirect('login', navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.logout');
    }
}