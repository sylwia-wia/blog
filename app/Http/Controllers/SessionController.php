<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email'=> 'required|email',
            'password' => 'required'
        ]);

        if(auth()->attempt($attributes)) {
            session()->regenerate();
            return redirect('/')->with('success', 'Witaj ponownie!');
        }

        throw ValidationException::withMessages([
            'email' => 'Niewłaściwy email!'
        ]);
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'Do zobczenia!');
    }
}
