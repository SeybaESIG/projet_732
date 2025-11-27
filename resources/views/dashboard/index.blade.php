@extends('layouts.app')

@section('title', 'Tableau de bord | ' . config('app.name', 'Marketplace'))

@section('content')
    <section class="page-header">
        <h1>Tableau de bord</h1>
        <p>Visualisez en un coup d’œil vos annonces, vos alertes et vos échanges en cours. Cette page s’appuiera sur les endpoints API (annonces, favoris, recherches, messagerie) une fois raccordés.</p>
    </section>

    <section class="grid" style="grid-template-columns:repeat(auto-fit, minmax(220px, 1fr)); margin-bottom:2rem;">
        <div class="card">
            <h3 style="margin-top:0;">Annonces actives</h3>
            <p style="margin:0; font-size:2.2rem; font-weight:700;">0</p>
            <p style="margin:0.35rem 0 0; color:var(--muted); font-size:0.9rem;">Données alimentées par l’API `/annonces` (statut = active).</p>
        </div>
        <div class="card">
            <h3 style="margin-top:0;">Favoris</h3>
            <p style="margin:0; font-size:2.2rem; font-weight:700;">0</p>
            <p style="margin:0.35rem 0 0; color:var(--muted); font-size:0.9rem;">Synchronisé avec les endpoints favoris / likes.</p>
        </div>
        <div class="card">
            <h3 style="margin-top:0;">Alertes actives</h3>
            <p style="margin:0; font-size:2.2rem; font-weight:700;">0</p>
            <p style="margin:0.35rem 0 0; color:var(--muted); font-size:0.9rem;">Basé sur les recherches sauvegardées (API `/alertes`).</p>
        </div>
        <div class="card">
            <h3 style="margin-top:0;">Conversations</h3>
            <p style="margin:0; font-size:2.2rem; font-weight:700;">0</p>
            <p style="margin:0.35rem 0 0; color:var(--muted); font-size:0.9rem;">À intégrer avec la messagerie sécurisée.</p>
        </div>
    </section>

    <section class="grid" style="grid-template-columns:repeat(auto-fit, minmax(320px, 1fr)); gap:1.5rem;">
        <div class="card">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
                <h2 style="margin:0;">Mes annonces</h2>
                <a class="btn btn-outline" href="{{ route('annonces.create') }}">Publier</a>
            </div>
            <p style="margin:0; color:var(--muted); font-size:0.95rem;">Liste alimentée par `GET /api/annonces?user_id=me`. Chaque ligne affichera le statut, le nombre de vues, la date de publication et les actions (éditer, archiver).</p>
        </div>

        <div class="card">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
                <h2 style="margin:0;">Alertes sauvegardées</h2>
                <a class="btn btn-outline" href="{{ route('annonces.alert') }}">Nouvelle alerte</a>
            </div>
            <p style="margin:0; color:var(--muted); font-size:0.95rem;">Table alimentée par `GET /api/alertes`. Chaque alerte contiendra les critères (catégorie, budget, localisation) et une option pour la mettre en pause ou la supprimer.</p>
        </div>

        <div class="card">
            <h2 style="margin:0 0 1rem;">Activité récente</h2>
            <p style="margin:0; color:var(--muted); font-size:0.95rem;">Timeline alimentée par les événements (nouvelles offres, messages reçus, annonces favorites). Données à récupérer via un endpoint type `/api/activites`.</p>
        </div>
    </section>
@endsection
