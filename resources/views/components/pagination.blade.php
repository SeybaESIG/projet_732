@props(['paginator'])

@if ($paginator instanceof \Illuminate\Contracts\Pagination\Paginator && $paginator->hasPages())
    <nav aria-label="Pagination" style="margin-top:1.5rem;">
        <ul style="list-style:none; display:flex; gap:0.5rem; padding:0; margin:0;">
            @if ($paginator->onFirstPage())
                <li style="padding:0.45rem 0.9rem; border-radius:10px; background:rgba(148,163,184,0.15); color:var(--muted);">
                    Prec.
                </li>
            @else
                <li>
                    <a class="btn btn-outline" style="padding:0.45rem 0.9rem;" href="{{ $paginator->previousPageUrl() }}">Prec.</a>
                </li>
            @endif

            @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li style="padding:0.45rem 0.9rem; border-radius:10px; background:var(--primary); color:#fff;">
                        {{ $page }}
                    </li>
                @else
                    <li>
                        <a class="btn btn-outline" style="padding:0.45rem 0.9rem;" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li>
                    <a class="btn btn-outline" style="padding:0.45rem 0.9rem;" href="{{ $paginator->nextPageUrl() }}">Suiv.</a>
                </li>
            @else
                <li style="padding:0.45rem 0.9rem; border-radius:10px; background:rgba(148,163,184,0.15); color:var(--muted);">
                    Suiv.
                </li>
            @endif
        </ul>
    </nav>
@endif
