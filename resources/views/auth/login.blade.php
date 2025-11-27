@extends('layouts.app')

@section('title', 'Connexion | ' . config('app.name', 'Marketplace'))

@section('content')
    <section class="page-header">
        <h1>Se connecter</h1>
        <p>Interface de connexion à raccorder à `POST /api/auth/login` (authentification email + mot de passe). Prévoir la gestion des tokens/ sessions en API.</p>
    </section>

    <div class="card" style="display:grid; gap:1.2rem; max-width:480px;">
        <label style="display:flex; flex-direction:column; gap:0.4rem;">
            <span>Email</span>
            <input type="email" placeholder="vous@example.com" style="padding:0.85rem; border-radius:12px; border:1px solid var(--border);">
        </label>
        <label style="display:flex; flex-direction:column; gap:0.4rem;">
            <span>Mot de passe</span>
            <input type="password" placeholder="••••••••" style="padding:0.85rem; border-radius:12px; border:1px solid var(--border);">
        </label>
        <div style="display:flex; justify-content:space-between; align-items:center;">
            <label style="display:flex; align-items:center; gap:0.4rem; font-size:0.9rem; color:var(--muted);">
                <input type="checkbox"> Se souvenir de moi
            </label>
            <a href="#" style="color:var(--primary); font-size:0.9rem;">Mot de passe oublié ?</a>
        </div>
        <button class="btn btn-primary" type="button">Connexion (via API)</button>
        <a class="btn btn-outline" href="{{ route('auth.google.redirect') }}" style="text-align:center;">Se connecter avec Google</a>
        <div style="text-align:center; font-size:0.9rem;">
            Pas encore de compte ? <a href="{{ route('register') }}" style="color:var(--primary);">S’inscrire</a>
        </div>
    </div>
@endsection
