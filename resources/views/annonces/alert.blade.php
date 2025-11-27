@extends('layouts.app')

@section('title', 'Créer une alerte | ' . config('app.name', 'Marketplace'))

@section('content')
    <section class="page-header">
        <h1>Alertes personnalisées</h1>
        <p>Enregistrez vos critères pour recevoir automatiquement une notification dès qu’une annonce correspondante est publiée.</p>
    </section>

    <div class="card" style="display:grid; gap:1.5rem;">
        <section>
            <h2 style="margin-top:0;">Pourquoi créer une alerte ?</h2>
            <p style="margin:0; color:var(--muted);">Les alertes se basent sur les filtres sauvegardés (produit, budget, localisation, état). Lorsque l’API détecte une nouvelle annonce correspondant à ces critères, elle envoie un email ou SMS via le fournisseur transactionnel.</p>
        </section>

        <section style="display:grid; gap:1rem; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));">
            <label style="display:flex; flex-direction:column; gap:0.4rem;">
                <span>Produit recherché *</span>
                <input type="text" placeholder="Ex : MacBook Air M3" style="padding:0.85rem; border-radius:12px; border:1px solid var(--border);">
            </label>
            <label style="display:flex; flex-direction:column; gap:0.4rem;">
                <span>Budget maximum *</span>
                <input type="number" min="0" placeholder="€" style="padding:0.85rem; border-radius:12px; border:1px solid var(--border);">
            </label>
            <label style="display:flex; flex-direction:column; gap:0.4rem;">
                <span>Localisation</span>
                <input type="text" placeholder="Ville / rayon" style="padding:0.85rem; border-radius:12px; border:1px solid var(--border);">
            </label>
            <label style="display:flex; flex-direction:column; gap:0.4rem;">
                <span>Fréquence</span>
                <select style="padding:0.85rem; border-radius:12px; border:1px solid var(--border);">
                    <option>Notification instantanée</option>
                    <option>Récapitulatif quotidien</option>
                    <option>Récapitulatif hebdomadaire</option>
                </select>
            </label>
        </section>

        <section>
            <h2>API cible</h2>
            <ul style="margin:0; padding-left:1.1rem; color:var(--muted); display:flex; flex-direction:column; gap:0.6rem;">
                <li><code>POST /api/alertes</code> pour créer une alerte (stockage des critères + mode de notification).</li>
                <li><code>GET /api/alertes</code> pour lister et gérer les alertes de l’utilisateur.</li>
                <li>Intégration email/SMS via fournisseur tiers (transactionnel ou OTP).</li>
            </ul>
        </section>

        <div style="display:flex; justify-content:flex-end; gap:0.75rem;">
            <button class="btn btn-outline" type="button">Prévisualiser l’alerte</button>
            <button class="btn btn-primary" type="button">Enregistrer (via API)</button>
        </div>
    </div>
@endsection
