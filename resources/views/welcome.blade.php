<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Marketplace') }} | Revente entre particuliers</title>
        <style>
            :root {
                color-scheme: light;
                --bg: #f6f5ff;
                --bg-card: #ffffff;
                --bg-dark: #1e1b4b;
                --primary: #5646df;
                --primary-light: #7b6bfd;
                --accent: #ffb347;
                --text: #1f2933;
                --muted: #4b5563;
                --border: #e5e7eb;
                font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", Arial, sans-serif;
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                background: var(--bg);
                color: var(--text);
                line-height: 1.6;
            }

            a {
                color: inherit;
                text-decoration: none;
            }

            .container {
                width: min(1120px, 92%);
                margin: 0 auto;
            }

            header {
                position: sticky;
                top: 0;
                z-index: 10;
                background: rgba(246, 245, 255, 0.9);
                backdrop-filter: blur(12px);
                border-bottom: 1px solid var(--border);
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

            .nav-actions {
                display: flex;
                gap: 0.75rem;
            }

            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                border-radius: 999px;
                padding: 0.65rem 1.5rem;
                font-weight: 600;
                font-size: 0.95rem;
                border: 1px solid transparent;
                transition: transform 150ms ease, box-shadow 150ms ease, background 150ms ease;
            }

            .btn-primary {
                background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
                color: #ffffff;
                box-shadow: 0 10px 25px rgba(86, 70, 223, 0.25);
            }

            .btn-primary:hover {
                transform: translateY(-1px);
                box-shadow: 0 12px 30px rgba(86, 70, 223, 0.3);
            }

            .btn-outline {
                border-color: var(--primary);
                color: var(--primary);
                background: #ffffff;
            }

            .btn-outline:hover {
                background: rgba(86, 70, 223, 0.08);
            }

            .badge {
                display: inline-flex;
                align-items: center;
                gap: 0.35rem;
                background: rgba(86, 70, 223, 0.12);
                color: var(--primary);
                padding: 0.35rem 0.8rem;
                border-radius: 999px;
                font-size: 0.8rem;
                font-weight: 600;
                letter-spacing: 0.02em;
            }

            .hero {
                padding: 6rem 0 4rem;
            }

            .hero-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 3rem;
                align-items: center;
            }

            .hero-card {
                background: var(--bg-card);
                padding: 2.5rem;
                border-radius: 24px;
                box-shadow: 0 25px 60px rgba(30, 27, 75, 0.12);
                position: relative;
                overflow: hidden;
            }

            .hero-card::before {
                content: "";
                position: absolute;
                inset: -40% auto auto -40%;
                width: 70%;
                aspect-ratio: 1;
                background: radial-gradient(circle, rgba(86, 70, 223, 0.25) 0%, rgba(86, 70, 223, 0) 70%);
            }

            .hero h1 {
                font-size: clamp(2.4rem, 4vw, 3.1rem);
                line-height: 1.1;
                margin: 0 0 1.5rem;
            }

            .hero p {
                color: var(--muted);
                font-size: 1.05rem;
                margin-bottom: 2rem;
            }

            .action-row {
                display: flex;
                gap: 0.75rem;
                flex-wrap: wrap;
            }

            .hero-meta {
                display: flex;
                gap: 1.5rem;
                flex-wrap: wrap;
                margin-top: 2rem;
                color: var(--muted);
                font-size: 0.95rem;
            }

            .hero-meta strong {
                display: block;
                font-size: 1.35rem;
                color: var(--text);
            }

            .cards {
                display: grid;
                gap: 1.5rem;
            }

            .card {
                background: var(--bg-card);
                border-radius: 20px;
                padding: 1.75rem;
                border: 1px solid var(--border);
                box-shadow: 0 15px 40px rgba(17, 24, 39, 0.08);
            }

            .card-title {
                font-weight: 600;
                margin-bottom: 0.75rem;
                font-size: 1.15rem;
            }

            .muted {
                color: var(--muted);
            }

            .section-header {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
                margin-bottom: 2rem;
            }

            .section-header h2 {
                margin: 0;
                font-size: 1.9rem;
            }

            .categories {
                padding: 4rem 0;
            }

            .category-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
                gap: 1.25rem;
            }

            .category-card {
                background: var(--bg-card);
                border-radius: 18px;
                padding: 1.5rem;
                border: 1px solid var(--border);
                transition: transform 150ms ease;
            }

            .category-card:hover {
                transform: translateY(-4px);
            }

            .category-title {
                font-weight: 600;
                margin-bottom: 0.25rem;
            }

            .how-it-works {
                padding: 4rem 0;
                background: #ffffff;
            }

            .steps {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
                gap: 1.5rem;
            }

            .step-number {
                font-size: 2.5rem;
                font-weight: 700;
                color: var(--primary);
                margin-bottom: 0.5rem;
            }

            .cta {
                padding: 4rem 0 5rem;
            }

            .cta-inner {
                background: linear-gradient(135deg, var(--bg-dark) 0%, #312e81 100%);
                color: #f8fafc;
                border-radius: 24px;
                padding: 3rem;
                display: flex;
                flex-direction: column;
                gap: 1.5rem;
            }

            .cta-inner p {
                margin: 0;
                max-width: 480px;
            }

            .cta-actions {
                display: flex;
                gap: 0.75rem;
                flex-wrap: wrap;
            }

            footer {
                padding: 2.5rem 0;
                border-top: 1px solid var(--border);
                color: var(--muted);
                font-size: 0.9rem;
            }

            @media (max-width: 640px) {
                .nav-actions {
                    display: none;
                }

                .hero {
                    padding: 4rem 0 3rem;
                }

                .hero-card {
                    padding: 2rem;
                }

                .cta-inner {
                    padding: 2rem;
                }
            }
        </style>
    </head>
    <body>
        <header>
            <div class="container nav">
                <div class="brand">{{ config('app.name', 'Marketplace') }}</div>
                <nav class="nav-actions">
                    <a class="btn btn-outline" href="#categories">Explorer</a>
                    <a class="btn btn-primary" href="#cta">Deposer une annonce</a>
                </nav>
            </div>
        </header>

        <main>
            <section class="hero">
                <div class="container hero-grid">
                    <div class="hero-card">
                        <span class="badge">Revente entre particuliers</span>
                        <h1>Vendez et achetez en toute confiance autour de vous.</h1>
                        <p>Une place de marche locale pour donner une seconde vie a vos objets. Publiez votre annonce gratuitement, echangez en direct et concretisez vos ventes en un clin d'oeil.</p>
                        <div class="action-row">
                            <a class="btn btn-primary" href="#cta">Deposer une annonce</a>
                            <a class="btn btn-outline" href="#how-it-works">Comment ca marche ?</a>
                        </div>
                        <div class="hero-meta">
                            <div>
                                <strong>20 000+</strong>
                                annonces actives
                            </div>
                            <div>
                                <strong>98%</strong>
                                d'utilisateurs satisfaits
                            </div>
                            <div>
                                <strong>3 min</strong>
                                pour publier
                            </div>
                        </div>
                    </div>
                    <div class="cards">
                        <div class="card">
                            <div class="card-title">Trouvez la bonne affaire</div>
                            <p class="muted">Filtres par categorie, localisation et etat du produit pour denicher ce dont vous avez besoin.</p>
                        </div>
                        <div class="card">
                            <div class="card-title">Securisez vos echanges</div>
                            <p class="muted">Messagerie integree, profils verifies et systeme d'avis pour rassurer vendeurs et acheteurs.</p>
                        </div>
                        <div class="card">
                            <div class="card-title">Suivez vos transactions</div>
                            <p class="muted">Tableau de bord clair pour gerer vos annonces, rendez-vous et paiements.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="categories" id="categories">
                <div class="container">
                    <div class="section-header">
                        <span class="badge">Explorer les categories</span>
                        <h2>Tout pour consommer plus responsable</h2>
                    </div>
                    <div class="category-grid">
                        <div class="category-card">
                            <div class="category-title">Tech et electronique</div>
                            <p class="muted">Smartphones, ordinateurs, accessoires gaming, audio...</p>
                        </div>
                        <div class="category-card">
                            <div class="category-title">Maison et decoration</div>
                            <p class="muted">Mobilier, electromenager, deco, art de la table.</p>
                        </div>
                        <div class="category-card">
                            <div class="category-title">Mode et lifestyle</div>
                            <p class="muted">Vetements, sneakers, montres, sacs, equipements sportifs.</p>
                        </div>
                        <div class="category-card">
                            <div class="category-title">Enfants et loisirs</div>
                            <p class="muted">Puericulture, jouets, jeux video, livres et BD.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="how-it-works" id="how-it-works">
                <div class="container">
                    <div class="section-header">
                        <span class="badge">Comment ca marche ?</span>
                        <h2>Publiez, discutez, concluez en quelques minutes</h2>
                    </div>
                    <div class="steps">
                        <div class="card">
                            <div class="step-number">1</div>
                            <div class="card-title">Publiez votre annonce</div>
                            <p class="muted">Ajoutez des photos, choisissez une categorie, decrivez l'etat et fixez votre prix. Tout se fait depuis votre dashboard.</p>
                        </div>
                        <div class="card">
                            <div class="step-number">2</div>
                            <div class="card-title">Discutez en direct</div>
                            <p class="muted">Recevez les messages des acheteurs, partagez des informations et proposez un rendez-vous en quelques clics.</p>
                        </div>
                        <div class="card">
                            <div class="step-number">3</div>
                            <div class="card-title">Concluez sereinement</div>
                            <p class="muted">Suivez la transaction, marquez l'objet comme vendu et collectez les avis pour renforcer votre reputation.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="cta" id="cta">
                <div class="container">
                    <div class="cta-inner">
                        <span class="badge">Pret a commencer ?</span>
                        <h2>Publiez votre premiere annonce des aujourd'hui.</h2>
                        <p>Choisissez la categorie, ajoutez quelques photos et lancez-vous. Notre equipe vous accompagne et notre communaute est prete a decouvrir vos trouvailles.</p>
                        <div class="cta-actions">
                            @if (Route::has('login'))
                                <a class="btn btn-primary" href="{{ route('login') }}">Se connecter</a>
                            @else
                                <a class="btn btn-primary" href="#">Se connecter</a>
                            @endif
                            @if (Route::has('register'))
                                <a class="btn btn-outline" href="{{ route('register') }}">Creer un compte</a>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer>
            <div class="container">
                &copy; {{ date('Y') }} {{ config('app.name', 'Marketplace') }}. Tous droits reserves.
            </div>
        </footer>
    </body>
</html>
