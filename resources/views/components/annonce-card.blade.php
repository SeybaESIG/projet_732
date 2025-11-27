@props(['annonce'])

<article class="card" style="display:flex; flex-direction:column; gap:0.9rem;">
    <div style="display:flex; justify-content:space-between; gap:0.75rem; align-items:flex-start;">
        <div>
            <h3 style="margin:0; font-size:1.2rem;">
                {{ $annonce->titre ?? 'Titre inconnu' }}
            </h3>
            <p style="margin:0.35rem 0 0; color:var(--muted); font-size:0.9rem;">
                {{ $annonce->ville->nom ?? $annonce->ville_name ?? 'Localisation non renseignee' }}
            </p>
        </div>
        <strong style="font-size:1.1rem;">
            @if (isset($annonce->prix))
                {{ number_format($annonce->prix, 2, ',', ' ') }} €
            @else
                -
            @endif
        </strong>
    </div>

    <p style="margin:0; color:var(--text);">
        {{ \Illuminate\Support\Str::limit($annonce->description ?? 'Aucune description.', 160) }}
    </p>

    <div style="display:flex; justify-content:space-between; align-items:center;">
        <span style="font-size:0.85rem; color:var(--muted);">
            Publiée le {{ optional($annonce->created_at)->format('d/m/Y') ?? 'à définir via API' }}
        </span>
        <a class="btn btn-outline" href="#">
            Voir l'annonce
        </a>
    </div>
</article>
