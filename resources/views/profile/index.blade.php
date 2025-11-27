@extends('layouts.app')

@section('title', 'Profil utilisateur | ' . config('app.name', 'Marketplace'))

@section('content')
    <section class="page-header">
        <h1>Mon profil</h1>
        <p>Cette page affichera les informations du compte, les coordonnées et les paramètres de sécurité une fois connectée à l’API utilisateur.</p>
    </section>

    <div class="grid" style="grid-template-columns:repeat(auto-fit, minmax(260px, 1fr)); gap:1.5rem;">
        <div class="card">
            <h2 style="margin-top:0;">Informations personnelles</h2>
            <p style="margin:0; color:var(--muted);">Données issues de `GET /api/users/me` : nom, prénom, email, téléphone, localisation. Ajouter des badges (profil vérifié, vendeur fiable…) selon les règles métier.</p>
        </div>
        <div class="card">
            <h2 style="margin-top:0;">Paramètres de sécurité</h2>
            <p style="margin:0; color:var(--muted);">Prévoir la gestion du mot de passe, des connexions actives, des méthodes d’authentification secondaire. Endpoints possibles : `PUT /api/users/me`, `POST /api/users/me/password`, etc.</p>
        </div>
        <div class="card">
            <h2 style="margin-top:0;">Historique et réputation</h2>
            <p style="margin:0; color:var(--muted);">Lister les avis, les évaluations et les ventes conclues. À alimenter via un endpoint dédié (`GET /api/users/me/reviews`).</p>
        </div>
    </div>
@endsection
