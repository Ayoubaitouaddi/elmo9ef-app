@extends('layouts')
@section('title', "Login / Sign Up")
@section('content')
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="auth-container text-center p-4 bg-white rounded shadow">
        <h2 class="mb-4">elmoo9ef</h2>
        <!-- Bouton pour l'Inscription (Sign up) -->
        <a href="{{ route('register') }}" class="btn btn-primary btn-block mb-3">Sign up</a>
        
        <!-- Bouton pour la Connexion (Log in) -->
        <a href="{{ route('login') }}" class="btn btn-secondary btn-block mb-4">Log in</a>
        
        <div class="terms">
            <p class="terms-p">En vous inscrivant, vous acceptez nos <strong><a href="#" class="tearms-txt">Conditions d'utilisation</a> et notre <a href="#" class="tearms-txt">Politique de confidentialité</a>.</strong></p>
        </div>
    </div>
</div>
@endsection