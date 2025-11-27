@extends('layouts.app')

@section('title', 'Détail annonce | ' . config('app.name', 'Marketplace'))

@section('content')
    <article class="page-header" style="margin-bottom:1.5rem;">
        <h1>Titre de l’annonce (API)</h1>
        <p style="color:var(--muted); margin-top:0.5rem;">Publié le JJ/MM/AAAA • Ville / Localisation • Statut (Disponible, Vendue, En discussion)</p>
    </article>

    <section class="grid" style="grid-template-columns:2fr 1fr; gap:2rem; align-items:flex-start;">
        <div class="card">
            <h2 style="margin-top:0;">Description détaillée</h2>
            <p style="margin:0; color:var(--muted);">
                Zone alimentée par `GET /api/annonces/{id}` : description longue, caractéristiques, état, modalités de remise. Prévoir une galerie médias (photos/vidéo) et une carte de localisation approximative.
            </p>
        </div>

        <aside class="card" style="display:flex; flex-direction:column; gap:1rem;">
            <div>
                <span style="font-size:0.85rem; color:var(--muted);">Prix</span>
                <h3 style="margin:0.3rem 0 0; font-size:1.6rem;">000,00 €</h3>
                <p style="margin:0; color:var(--muted); font-size:0.9rem;">Indication récupérée depuis l’API (prix fixe, négociable, gratuit). Ajouter TVA, frais ou promotion si besoin.</p>
            </div>
            <div>
                <span style="font-size:0.85rem; color:var(--muted);">Vendeur</span>
                <p style="margin:0.3rem 0 0;">Nom du vendeur, badge de confiance, nombre de ventes. Source : `GET /api/users/{id}`.</p>
            </div>
            <div style="display:flex; flex-direction:column; gap:0.6rem;">
                <a class="btn btn-primary" href="#">Contacter via messagerie</a>
                <a class="btn btn-outline" href="{{ route('annonces.browse') }}">Retour aux résultats</a>
            </div>
        </aside>
    </section>

    <section style="margin-top:2.5rem;">
        <h2 style="margin-bottom:1rem;">Annonces similaires</h2>
        <p style="margin:0; color:var(--muted); font-size:0.95rem;">À afficher via un appel `GET /api/annonces?categorie=...&ville=...` ou un endpoint de recommandation. Prévoir un carrousel ou une grille de cartes.</p>
    </section>
@endsection
