<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['nullable', 'string', 'max:20'],
            'code_postal' => ['nullable', 'string', 'max:10'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Créer un nouvel utilisateur
        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name, // Combine first and last name
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'code_postal' => $request->code_postal,
            'password' => Hash::make($request->password),
        ]);

        // Déclencher l'événement Registered
        event(new Registered($user));

        // Connecter l'utilisateur
        Auth::login($user);

        // Rediriger vers la page d'accueil ou le tableau de bord
        return redirect('/');
    }
}
