@props([
    'title' => 'Rien a afficher pour le moment.',
    'message' => 'Revenez plus tard ou essayez d\'ajuster vos filtres.',
    'action' => null,
    'actionLabel' => 'Nouvelle action',
])

<section class="card" style="text-align:center; padding:2.5rem 1.5rem;">
    <div style="font-size:3rem; opacity:0.15;">&#128229;</div>
    <h3 style="margin:0.75rem 0 0;">
        {{ $title }}
    </h3>
    <p style="margin:0.5rem auto 1.5rem; max-width:420px; color:var(--muted);">
        {{ $message }}
    </p>
    @if ($action)
        <a class="btn btn-primary" href="{{ $action }}">
            {{ $actionLabel }}
        </a>
    @endif
</section>
