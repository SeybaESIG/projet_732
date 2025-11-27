@extends('layouts.app')

@section('title', 'Publier une annonce | ' . config('app.name', 'Marketplace'))

@section('content')
    <section class="page-header">
        <h1>Publier une annonce</h1>
        <p>Complétez les informations ci-dessous et validez pour rendre votre annonce visible par la communauté.</p>
    </section>

    @if ($errors->any())
        <div class="card" style="border-left:4px solid #ef4444; color:#b91c1c;">
            <h3 style="margin-top:0;">Impossible de publier l’annonce</h3>
            <ul style="margin:0; padding-left:1.1rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="card" style="display:grid; gap:1.5rem;" method="POST" action="{{ route('annonces.store') }}">
        @csrf

        <section>
            <h2 style="margin-top:0;">Résumé du flux</h2>
            <ol style="margin:0; padding-left:1.2rem; color:var(--muted); display:flex; flex-direction:column; gap:0.6rem;">
                <li>Le vendeur remplit le formulaire (titre, catégorie, état, prix, description, localisation).</li>
                <li>Il publie l’annonce (statut <em>active</em>) ou définit une date de mise en ligne future.</li>
                <li>L’annonce apparaît immédiatement dans l’espace « Parcourir » et dans le tableau de bord.</li>
            </ol>
        </section>

        <section style="display:grid; gap:1rem; grid-template-columns:repeat(auto-fit, minmax(260px, 1fr));">
            <label style="display:flex; flex-direction:column; gap:0.4rem;">
                <span>Titre</span>
                <input type="text" name="titre" value="{{ old('titre') }}" placeholder="Ex : Canapé d’angle convertible" style="padding:0.85rem; border-radius:12px; border:1px solid var(--border);">
                @error('titre') <small style="color:#ef4444;">{{ $message }}</small> @enderror
            </label>
            <label style="display:flex; flex-direction:column; gap:0.4rem;">
                <span>Catégorie (optionnel)</span>
                <select style="padding:0.85rem; border-radius:12px; border:1px solid var(--border);">
                    <option>Choisir une catégorie</option>
                    <option>Électronique</option>
                    <option>Maison & Jardin</option>
                    <option>Mode & Lifestyle</option>
                    <option>Immobilier</option>
                    <option>Véhicules</option>
                </select>
            </label>
            <label style="display:flex; flex-direction:column; gap:0.4rem;">
                <span>Prix (EUR) *</span>
                <input type="number" name="prix" value="{{ old('prix') }}" min="0" step="0.01" placeholder="ex : 350" required style="padding:0.85rem; border-radius:12px; border:1px solid var(--border);">
                @error('prix') <small style="color:#ef4444;">{{ $message }}</small> @enderror
            </label>
            <label style="display:flex; flex-direction:column; gap:0.4rem;">
                <span>Date de publication</span>
                <input type="datetime-local" name="date_publication" value="{{ old('date_publication') }}" style="padding:0.85rem; border-radius:12px; border:1px solid var(--border);">
                @error('date_publication') <small style="color:#ef4444;">{{ $message }}</small> @enderror
            </label>
            <label style="display:flex; flex-direction:column; gap:0.4rem;">
                <span>Statut</span>
                <select name="statut" style="padding:0.85rem; border-radius:12px; border:1px solid var(--border);">
                    <option value="">Auto (active)</option>
                    <option value="active" @selected(old('statut') === 'active')>Active</option>
                    <option value="vendue" @selected(old('statut') === 'vendue')>Vendue</option>
                </select>
                @error('statut') <small style="color:#ef4444;">{{ $message }}</small> @enderror
            </label>
        </section>

        <section>
            <h2>Description</h2>
            <textarea name="description" rows="6" style="width:100%; padding:1rem; border-radius:12px; border:1px solid var(--border);" placeholder="Décrivez l’état, les spécifications, le mode de remise..." required>{{ old('description') }}</textarea>
            @error('description') <small style="color:#ef4444;">{{ $message }}</small> @enderror
        </section>

        <section>
            <h2>Options d’alerte</h2>
            <p style="margin:0; color:var(--muted); font-size:0.9rem;">Ces paramètres seront implémentés une fois la messagerie/alertes disponibles (email/SMS).</p>
        </section>

        <div style="display:flex; justify-content:flex-end; gap:0.75rem;">
            <button class="btn btn-outline" type="reset">Réinitialiser</button>
            <button class="btn btn-primary" type="submit">Publier</button>
        </div>
    </form>
@endsection
