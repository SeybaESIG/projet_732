@extends('layouts.app')

@section('title', config('app.name', 'Marketplace') . ' | Accueil')

@section('content')
    <section class="page-header">
        <h1>La plateforme de revente entre particuliers</h1>
        <p>Decouvrez des milliers d'annonces verifiees, publiez les votres et rencontrez des acheteurs autour de vous.</p>
    </section>

    <section class="card" style="margin-bottom:2.5rem;">
        <form action="{{ url('/annonces') }}" method="GET" style="display:grid; gap:1rem; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr)); align-items:end;">
            <label style="display:flex; flex-direction:column; gap:0.35rem;">
                <span style="font-size:0.9rem; color:var(--muted);">Que cherchez-vous ?</span>
                <input type="text" name="q" placeholder="Ex: velo, smartphone..." style="padding:0.9rem; border-radius:12px; border:1px solid var(--border); font-size:0.95rem;">
            </label>
            <label style="display:flex; flex-direction:column; gap:0.35rem;">
                <span style="font-size:0.9rem; color:var(--muted);">Ville</span>
                <input type="text" name="ville" placeholder="Paris, Lyon..." style="padding:0.9rem; border-radius:12px; border:1px solid var(--border); font-size:0.95rem;">
            </label>
            <label style="display:flex; flex-direction:column; gap:0.35rem;">
                <span style="font-size:0.9rem; color:var(--muted);">Budget max</span>
                <input type="number" min="0" name="prix_max" placeholder="€" style="padding:0.9rem; border-radius:12px; border:1px solid var(--border); font-size:0.95rem;">
            </label>
            <div>
                <button class="btn btn-primary" type="submit" style="width:100%;">Rechercher</button>
            </div>
        </form>
    </section>

    <section style="margin-bottom:2.5rem;">
        <div class="page-header" style="margin-bottom:1.5rem;">
            <h2 style="margin:0; font-size:1.6rem;">Annonces recentes</h2>
            <p style="margin:0.35rem 0 0; color:var(--muted);">Les derniers objets disponibles pres de chez vous.</p>
        </div>
        <div class="grid" style="grid-template-columns:repeat(auto-fit, minmax(260px, 1fr));">
            @forelse (($annonces ?? []) as $annonce)
                <x-annonce-card :annonce="$annonce" />
            @empty
                <x-empty-state
                    title="Pas encore d'annonces."
                    message="Dès qu'une annonce sera publiee, elle apparaitra ici."
                    :action="url('/annonces')"
                    action-label="Explorer les annonces"
                />
            @endforelse
        </div>
    </section>

    <section>
        <div class="page-header" style="margin-bottom:1.5rem;">
            <h2 style="margin:0; font-size:1.6rem;">Encheres a venir</h2>
            <p style="margin:0.35rem 0 0; color:var(--muted);">Inscrivez-vous et participez aux ventes en direct.</p>
        </div>
        <div class="grid" style="grid-template-columns:repeat(auto-fit, minmax(260px, 1fr));">
            @forelse (($encheres ?? []) as $enchere)
                <x-enchere-card :enchere="$enchere" />
            @empty
                <x-empty-state
                    title="Pas d'enchere planifiee."
                    message="Creez la premiere enchere ou revenez plus tard."
                    :action="auth()->check() ? url('/encheres/manage/create') : route('auth.google.redirect')"
                    action-label="{{ auth()->check() ? 'Programmer une enchere' : 'Connexion requise' }}"
                />
            @endforelse
        </div>
    </section>
@endsection
