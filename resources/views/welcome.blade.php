@extends('layouts.app')

@section('title', config('app.name', 'Marketplace') . ' | Revente entre particuliers')

@push('styles')
    <style>
        .hero {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2.5rem;
            align-items: center;
            padding: 3rem 0 2rem;
        }

        .hero-copy h1 {
            font-size: clamp(2.4rem, 4vw, 3.1rem);
            margin: 0 0 1rem;
        }

        .hero-copy p {
            margin: 0 0 2rem;
            color: var(--muted);
            font-size: 1.05rem;
        }

        .hero-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .card-grid {
            display: grid;
            gap: 1.5rem;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        }

        .feature-card {
            background: var(--bg-card);
            border-radius: 20px;
            border: 1px solid rgba(148, 163, 184, 0.2);
            padding: 1.5rem;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.08);
        }

        .feature-card h3 {
            margin: 0 0 0.75rem;
            font-size: 1.2rem;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.35rem 0.75rem;
            border-radius: 999px;
            background: rgba(86, 70, 223, 0.12);
            color: var(--primary);
            font-size: 0.8rem;
            font-weight: 600;
        }

        .step-list {
            display: grid;
            gap: 1.2rem;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        }

        .step {
            background: var(--bg-card);
            border-radius: 18px;
            padding: 1.5rem;
            border: 1px solid rgba(148, 163, 184, 0.2);
        }

        .step-number {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            margin-bottom: 0.8rem;
        }

        .search-panel {
            background: #fff;
            border-radius: 24px;
            border: 1px solid rgba(148, 163, 184, 0.25);
            padding: 2rem;
            display: grid;
            gap: 1.2rem;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            box-shadow: 0 25px 60px rgba(30, 27, 75, 0.12);
        }

        .search-panel label {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
            font-size: 0.85rem;
            color: var(--muted);
        }

        .search-panel input,
        .search-panel select {
            padding: 0.85rem;
            border-radius: 12px;
            border: 1px solid var(--border);
            font-size: 0.95rem;
        }

        .cta-banner {
            margin-top: 2.5rem;
            border-radius: 24px;
            padding: 2.5rem;
            background: linear-gradient(135deg, var(--bg-dark) 0%, #312e81 100%);
            color: #f9fafb;
            display: grid;
            gap: 1.5rem;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            align-items: center;
        }

        @media (max-width: 720px) {
            .hero {
                padding-top: 2rem;
            }
        }
    </style>
@endpush

@section('content')
    <section class="hero">
        <div class="hero-copy">
            <span class="badge">Revente entre particuliers & alertes intelligentes</span>
            <h1>Inscrivez-vous, publiez, trouvez l’annonce parfaite.</h1>
            <p>Marketplace centralise toutes les annonces et recherches : créez votre profil, publiez vos produits ou vos besoins, et laissez nos alertes vous prévenir dès qu’une opportunité correspond.</p>
            <div class="hero-actions">
                @auth
                    <a class="btn btn-primary" href="{{ route('dashboard') }}">Accéder à mon tableau de bord</a>
                    <a class="btn btn-outline" href="{{ route('annonces.create') }}">Publier une annonce</a>
                @else
                    <a class="btn btn-primary" href="{{ route('auth.google.redirect') }}">Se connecter avec Google</a>
                    <a class="btn btn-outline" href="{{ route('annonces.browse') }}">Explorer les annonces</a>
                @endauth
            </div>
        </div>
        <div class="feature-card">
            <h3>Tout commence par 3 actions</h3>
            <ul style="margin:0; padding-left:1.1rem; color:var(--muted); display:flex; flex-direction:column; gap:0.8rem;">
                <li>Créez votre profil pour accéder à la messagerie et aux alertes personnalisées.</li>
                <li>Publiez une annonce détaillée (titre, description, photos, localisation, prix).</li>
                <li>Activez des alertes pour être averti dès qu’un produit correspond à vos critères.</li>
            </ul>
        </div>
    </section>

    <section style="margin:3rem 0;">
        <span class="badge">Fonctionnalités clés</span>
        <h2 style="margin:0.75rem 0 2rem;">Marketplace vous accompagne tout au long de votre parcours</h2>
        <div class="card-grid">
            <div class="feature-card">
                <h3>Inscription simplifiée</h3>
                <p>Créez votre compte via email en moins de deux minutes. Complétez votre profil pour sécuriser vos échanges et gagner la confiance des autres membres.</p>
            </div>
            <div class="feature-card">
                <h3>Publication d’annonce</h3>
                <p>Ajoutez un titre percutant, une description complète, fixez votre prix et joignez des médias. Chaque annonce peut être enregistrée en brouillon avant mise en ligne.</p>
            </div>
            <div class="feature-card">
                <h3>Alertes & recherches sauvegardées</h3>
                <p>Paramétrez des alertes sur vos catégories favorites (budget, localisation, état). Dès qu’une annonce correspond, vous recevez une notification instantanée.</p>
            </div>
            <div class="feature-card">
                <h3>Tableau de bord unifié</h3>
                <p>Suivez vos annonces actives, vos favoris, vos alertes et le statut de vos conversations depuis un seul espace responsive (desktop & mobile).</p>
            </div>
        </div>
    </section>

    <section style="margin:3rem 0;">
        <div class="badge">Recherche et correspondance</div>
        <h2 style="margin:0.75rem 0 2rem;">Un moteur de recherche pensé pour trouver la bonne annonce rapidement</h2>
        <div class="search-panel">
            <label>
                Mots-clés
                <input type="text" placeholder="Ex : vélo électrique, iPhone 14...">
            </label>
            <label>
                Catégorie
                <select>
                    <option>-- Sélectionner --</option>
                    <option>Électronique</option>
                    <option>Immobilier</option>
                    <option>Mode & Lifestyle</option>
                    <option>Maison & Jardin</option>
                </select>
            </label>
            <label>
                Localisation
                <input type="text" placeholder="Ville ou code postal">
            </label>
            <label>
                Budget max (€)
                <input type="number" min="0" placeholder="ex : 800">
            </label>
            <div style="display:flex; flex-direction:column; justify-content:flex-end; gap:0.6rem;">
                <a class="btn btn-primary" href="{{ route('annonces.browse') }}">Lancer la recherche</a>
                <a class="btn btn-outline" href="{{ route('annonces.alert') }}">Créer une alerte</a>
            </div>
        </div>
    </section>

    <section style="margin:3rem 0;">
        <div class="badge">Les 3 étapes du parcours</div>
        <h2 style="margin:0.75rem 0 2rem;">Comment tout utilisateur (acheteur ou vendeur) utilise Marketplace</h2>
        <div class="step-list">
            <div class="step">
                <div class="step-number">1</div>
                <h3>Inscription & profil</h3>
                <p>Créez votre compte, validez votre email et complétez vos informations (téléphone, localisation). Un profil fiable facilite les échanges et l’accès à la messagerie.</p>
            </div>
            <div class="step">
                <div class="step-number">2</div>
                <h3>Publier ou rechercher</h3>
                <p>Vendez un produit ou créez une alerte d’achat. Chaque annonce peut inclure un statut (disponible/vendue) et reste modifiable depuis votre tableau de bord.</p>
            </div>
            <div class="step">
                <div class="step-number">3</div>
                <h3>Suivre et conclure</h3>
                <p>Recevez des notifications (email/SMS), échangez via la messagerie sécurisée et finalisez la transaction. Archivez l’annonce ou marquez-la comme vendue.</p>
            </div>
        </div>
    </section>

    <section class="cta-banner">
        <div>
            <h2 style="margin:0 0 1rem;">Prêt à publier votre prochaine annonce ?</h2>
            <p style="margin:0;">Marketplace vous permet de créer des annonces complètes, de sauvegarder vos recherches et d’être alerté en temps réel. Tout est centralisé dans votre tableau de bord responsive.</p>
        </div>
        <div style="display:flex; flex-direction:column; gap:0.75rem;">
            <a class="btn btn-primary" href="{{ route('annonces.create') }}">Publier une annonce</a>
            <a class="btn btn-outline" href="{{ route('annonces.alert') }}">Activer une alerte personnalisée</a>
        </div>
    </section>
@endsection
