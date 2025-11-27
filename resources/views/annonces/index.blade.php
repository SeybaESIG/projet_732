@extends('layouts.app')

@section('title', 'Annonces | ' . config('app.name', 'Marketplace'))

@section('content')
    <section class="page-header">
        <h1>Annonces disponibles</h1>
        <p>Trouvez la bonne affaire en filtrant par categorie, localisation ou prix.</p>
    </section>

    <section class="card" style="margin-bottom:2rem;">
        <form data-filter-form style="display:grid; gap:1rem; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));">
            <label style="display:flex; flex-direction:column; gap:0.3rem;">
                <span style="font-size:0.85rem; color:var(--muted);">Mots-clés</span>
                <input type="text" name="q" placeholder="Titre, description..." style="padding:0.8rem; border-radius:12px; border:1px solid var(--border);">
            </label>
            <label style="display:flex; flex-direction:column; gap:0.3rem;">
                <span style="font-size:0.85rem; color:var(--muted);">Statut</span>
                <select name="statut" style="padding:0.8rem; border-radius:12px; border:1px solid var(--border);">
                    <option value="">Tous</option>
                    <option value="active">Active</option>
                    <option value="vendue">Vendue</option>
                </select>
            </label>
            <label style="display:flex; flex-direction:column; gap:0.3rem;">
                <span style="font-size:0.85rem; color:var(--muted);">Prix minimum</span>
                <input type="number" name="prix_min" min="0" placeholder="€" style="padding:0.8rem; border-radius:12px; border:1px solid var(--border);">
            </label>
            <label style="display:flex; flex-direction:column; gap:0.3rem;">
                <span style="font-size:0.85rem; color:var(--muted);">Prix maximum</span>
                <input type="number" name="prix_max" min="0" placeholder="€" style="padding:0.8rem; border-radius:12px; border:1px solid var(--border);">
            </label>
            <div style="display:flex; gap:0.75rem; align-items:flex-end;">
                <button class="btn btn-primary" type="submit">Filtrer</button>
                <button class="btn btn-outline" type="reset">Réinitialiser</button>
            </div>
        </form>
    </section>

    <section id="annonce-results" class="grid" style="grid-template-columns:repeat(auto-fit, minmax(260px, 1fr)); gap:1.5rem;">
        <div class="card" style="border-left:4px solid var(--primary);">
            <h2 style="margin-top:0;">Chargement des annonces…</h2>
            <p style="margin:0; color:var(--muted);">Nous interrogeons l’API `/api/annonces` pour récupérer les dernières publications.</p>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('annonce-results');
            const form = document.querySelector('[data-filter-form]');
            if (!container || !form) return;

            const renderCard = (annonce) => {
                const article = document.createElement('article');
                article.className = 'card';
                article.style.display = 'flex';
                article.style.flexDirection = 'column';
                article.style.gap = '0.9rem';

                article.innerHTML = `
                    <div style="display:flex; justify-content:space-between; gap:0.75rem; align-items:flex-start;">
                        <div>
                            <h3 style="margin:0; font-size:1.2rem;">${annonce.titre ?? 'Annonce sans titre'}</h3>
                            <p style="margin:0.35rem 0 0; color:var(--muted); font-size:0.9rem;">ID #${annonce.annonce_id}</p>
                        </div>
                        <strong style="font-size:1.1rem;">${annonce.prix ? new Intl.NumberFormat('fr-FR', { style:'currency', currency:'EUR' }).format(annonce.prix) : '-'}</strong>
                    </div>
                    <p style="margin:0; color:var(--text);">${annonce.description?.slice(0, 160) ?? 'Pas de description.'}</p>
                    <div style="display:flex; justify-content:space-between; align-items:center;">
                        <span style="font-size:0.85rem; color:var(--muted);">
                            Publiée le ${annonce.date_publication ? new Date(annonce.date_publication).toLocaleDateString('fr-FR') : 'n/a'}
                        </span>
                        <span style="font-size:0.85rem; color:var(--muted); text-transform:uppercase;">${annonce.statut ?? 'active'}</span>
                    </div>
                `;

                return article;
            };

            const fetchAnnonces = async (qs = '') => {
                container.innerHTML = '<div class="card">Chargement…</div>';
                try {
                    const response = await fetch(`{{ url('/api/annonces') }}${qs}`, {
                        headers: { 'Accept': 'application/json' },
                    });
                    if (!response.ok) throw new Error('API indisponible');
                    const annonces = await response.json();

                    container.innerHTML = '';
                    if (!annonces.length) {
                        container.innerHTML = '<div class="card">Aucune annonce ne correspond à vos filtres.</div>';
                        return;
                    }

                    annonces.forEach((annonce) => container.appendChild(renderCard(annonce)));
                } catch (error) {
                    console.error(error);
                    container.innerHTML = '<div class="card" style="color:#ef4444;">Impossible de récupérer les annonces. Vérifiez que l’API fonctionne.</div>';
                }
            };

            fetchAnnonces();

            form.addEventListener('submit', (event) => {
                event.preventDefault();
                const data = new FormData(form);
                const params = new URLSearchParams();
                data.forEach((value, key) => {
                    if (value) params.append(key, value);
                });
                const query = params.toString() ? `?${params.toString()}` : '';
                fetchAnnonces(query);
            });

            form.addEventListener('reset', () => {
                setTimeout(() => fetchAnnonces(), 0);
            });
        });
    </script>
@endpush
