<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            @yield('title', config('app.name', 'Marketplace'))
        </title>
        <style>
            :root {
                color-scheme: light;
                --bg: #f6f5ff;
                --bg-card: #ffffff;
                --bg-dark: #1e1b4b;
                --primary: #5646df;
                --primary-light: #7b6bfd;
                --accent: #ffb347;
                --text: #1f2937;
                --muted: #6b7280;
                --border: #e5e7eb;
                font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", Arial, sans-serif;
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                background: var(--bg);
                color: var(--text);
                line-height: 1.6;
            }

            a {
                color: inherit;
                text-decoration: none;
            }

            header {
                position: sticky;
                top: 0;
                z-index: 20;
                background: rgba(246, 245, 255, 0.96);
                border-bottom: 1px solid var(--border);
                backdrop-filter: blur(12px);
            }

            .container {
                width: min(1100px, 92%);
                margin: 0 auto;
            }

            .nav {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 1rem 0;
            }

            .brand {
                font-weight: 700;
                font-size: 1.25rem;
                color: var(--primary);
                letter-spacing: 0.02em;
            }

            .nav-links {
                display: flex;
                align-items: center;
                gap: 1rem;
                font-size: 0.95rem;
            }

            .nav-links a {
                padding: 0.35rem 0.6rem;
                border-radius: 999px;
                transition: background 150ms ease;
            }

            .nav-links a:hover {
                background: rgba(86, 70, 223, 0.1);
            }

            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                border-radius: 999px;
                padding: 0.55rem 1.3rem;
                font-weight: 600;
                font-size: 0.95rem;
                border: 1px solid transparent;
                transition: transform 150ms ease, box-shadow 150ms ease, background 150ms ease;
            }

            .btn-primary {
                background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
                color: #fff;
                box-shadow: 0 12px 32px rgba(86, 70, 223, 0.24);
            }

            .btn-outline {
                border: 1px solid var(--primary);
                color: var(--primary);
                background: #fff;
            }

            main {
                flex: 1;
                padding: 2.5rem 0;
            }

            .page-header {
                margin-bottom: 2rem;
            }

            .page-header h1 {
                margin: 0;
                font-size: clamp(1.9rem, 3vw, 2.6rem);
            }

            .page-header p {
                margin: 0.5rem 0 0;
                color: var(--muted);
            }

            .grid {
                display: grid;
                gap: 1.5rem;
            }

            footer {
                border-top: 1px solid var(--border);
                padding: 2rem 0;
                color: var(--muted);
                font-size: 0.9rem;
                background: #fff;
            }

            .card {
                background: var(--bg-card);
                border-radius: 20px;
                padding: 1.5rem;
                border: 1px solid rgba(148, 163, 184, 0.2);
                box-shadow: 0 18px 40px rgba(15, 23, 42, 0.08);
            }

            @media (max-width: 720px) {
                .nav {
                    flex-direction: column;
                    gap: 1rem;
                }

                .nav-links {
                    flex-wrap: wrap;
                    justify-content: center;
                }

                .nav-actions {
                    flex-wrap: wrap;
                    justify-content: center;
                }
            }
        </style>
        @stack('styles')
    </head>
    <body>
        @php
            use Illuminate\Support\Str;
        @endphp
        <header>
            <div class="container nav">
                <a class="brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Marketplace') }}
                </a>
                <nav class="nav-links">
                    <a href="{{ route('home') }}">Accueil</a>
                    <a href="{{ route('annonces.browse') }}">Parcourir</a>
                    <a href="{{ route('annonces.create') }}">Publier</a>
                    <a href="{{ route('annonces.alert') }}">Alertes</a>
                    <a href="{{ route('dashboard') }}">Tableau de bord</a>
                </nav>
                <div class="nav-links" style="gap:0.5rem;">
                    @auth
                        <form id="layout-logout-form" method="POST" action="{{ route('logout') }}" style="display:none;">
                            @csrf
                        </form>
                        <span style="font-size:0.9rem; color:var(--muted);">
                            Bonjour {{ auth()->user()->prenom ?? auth()->user()->nom ?? 'membre' }}
                        </span>
                        <button class="btn btn-outline" type="button" data-logout>
                            Déconnexion
                        </button>
                    @else
                        <a class="btn btn-outline" href="{{ route('auth.google.redirect') }}">Connexion Google</a>
                        <a class="btn btn-primary" href="{{ route('auth.google.redirect') }}">Publier une annonce</a>
                    @endauth
                </div>
            </div>
        </header>

        <main>
            <div class="container">
                @if (session('status'))
                    <div class="card" style="margin-bottom: 1.25rem; border-left: 4px solid var(--primary-light);">
                        {{ session('status') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="card" style="margin-bottom: 1.25rem; border-left: 4px solid #ef4444;">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>

        <footer>
            <div class="container">
                &copy; {{ date('Y') }} {{ config('app.name', 'Marketplace') }}. Tous droits reserves.
            </div>
        </footer>
        @auth
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const logout = document.querySelector('[data-logout]');
                    if (logout) {
                        logout.addEventListener('click', () => {
                            const form = document.getElementById('layout-logout-form');
                            if (form) form.submit();
                        });
                    }
                });
            </script>
        @endauth
        @stack('scripts')
    </body>
</html>
