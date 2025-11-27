@extends('layouts.app')

@section('title', 'Inscription | ' . config('app.name', 'Marketplace'))

@section('content')
    <section class="page-header">
        <h1>Créer un compte</h1>
        <p>Formulaire d’inscription à connecter à `POST /api/auth/register` (ou équivalent). Prévoir vérification email et activation du profil.</p>
    </section>

    <div class="card" style="display:grid; gap:1.2rem; max-width:640px;">
        <label style="display:flex; flex-direction:column; gap:0.4rem;">
            <span>Prénom *</span>
            <input type="text" placeholder="Votre prénom" style="padding:0.85rem; border-radius:12px; border:1px solid var(--border);">
        </label>
        <label style="display:flex; flex-direction:column; gap:0.4rem;">
            <span>Nom *</span>
            <input type="text" placeholder="Votre nom" style="padding:0.85rem; border-radius:12px; border:1px solid var(--border);">
        </label>
        <label style="display:flex; flex-direction:column; gap:0.4rem;">
            <span>Email *</span>
            <input type="email" placeholder="vous@example.com" style="padding:0.85rem; border-radius:12px; border:1px solid var(--border);">
        </label>
        <label style="display:flex; flex-direction:column; gap:0.4rem;">
            <span>Mot de passe *</span>
            <input type="password" placeholder="••••••••" style="padding:0.85rem; border-radius:12px; border:1px solid var(--border);">
        </label>
        <label style="display:flex; flex-direction:column; gap:0.4rem;">
            <span>Numéro de téléphone *</span>
            <input type="tel" placeholder="+33 6 12 34 56 78" style="padding:0.85rem; border-radius:12px; border:1px solid var(--border);">
        </label>
        <p style="margin:0; color:var(--muted); font-size:0.9rem;">En vous inscrivant, vous acceptez nos conditions générales. L’API devra envoyer un email de confirmation via le fournisseur transactionnel.</p>
        <div style="display:flex; gap:0.75rem; align-items:center; flex-wrap:wrap;">
            <button class="btn btn-primary" type="button">S’inscrire (via API)</button>
            <a class="btn btn-outline" href="{{ route('auth.google.redirect') }}">Continuer avec Google</a>
            <a href="{{ route('login') }}" style="color:var(--primary);">Déjà un compte ? Se connecter</a>
        </div>
    </div>
@endsection
