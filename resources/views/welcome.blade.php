<?php
// public/static-home.php
// Page PHP autonome — pas de routes Laravel requises
$sampleProducts = [
    ['name' => 'Sneakers confort', 'price' => '79,99 €', 'img' => 'https://via.placeholder.com/400x260?text=Sneakers'],
    ['name' => 'Casque Bluetooth', 'price' => '129,00 €', 'img' => 'https://via.placeholder.com/400x260?text=Casque'],
    ['name' => 'Lampadaire design', 'price' => '59,50 €', 'img' => 'https://via.placeholder.com/400x260?text=Lampe'],
    ['name' => 'Coffret cadeau', 'price' => '39,90 €', 'img' => 'https://via.placeholder.com/400x260?text=Coffret'],
];
$q = isset($_GET['q']) ? trim($_GET['q']) : '';
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Ma Boutique - Page PHP</title>
  <style>
    body{font-family:Arial,Helvetica,sans-serif;background:#f7fafc;color:#111;margin:0}
    .container{max-width:1100px;margin:24px auto;padding:16px}
    header{display:flex;gap:12px;align-items:center}
    .logo{color:#e11d48;font-weight:700}
    .search input{padding:8px;border:1px solid #e5e7eb;border-radius:6px}
    .grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:16px;margin-top:16px}
    .card{background:#fff;padding:12px;border-radius:8px;box-shadow:0 1px 4px rgba(0,0,0,.04);display:flex;flex-direction:column}
    .price{color:#e11d48;font-weight:700;margin-top:8px}
    footer{margin-top:28px;text-align:center;color:#6b7280;font-size:14px}
  </style>
</head>
<body>
  <div class="container">
    <header>
      <div class="logo">Ma Boutique</div>
      <form class="search" action="" method="get" style="margin-left:16px;flex:1;display:flex;gap:8px">
        <input type="search" name="q" placeholder="Rechercher..." value="<?php echo htmlspecialchars($q); ?>">
        <button type="submit">Rechercher</button>
      </form>
      <nav>
        <a href="#" style="margin-left:12px">Connexion</a>
        <a href="#" style="margin-left:8px">Panier</a>
      </nav>
    </header>

    <main>
      <section style="margin-top:20px">
        <h1 style="margin:0 0 8px">Produits</h1>
        <?php if ($q !== ''): ?>
          <p style="color:#555">Résultats pour « <?php echo htmlspecialchars($q); ?> »</p>
        <?php endif; ?>

        <div class="grid">
          <?php foreach ($sampleProducts as $p): ?>
            <?php
              // simple filtre côté serveur si une recherche est fournie
              if ($q !== '' && stripos($p['name'], $q) === false) {
                  continue;
              }
            ?>
            <div class="card">
              <img src="<?php echo htmlspecialchars($p['img']); ?>" alt="<?php echo htmlspecialchars($p['name']); ?>" style="width:100%;border-radius:6px;margin-bottom:8px">
              <div style="font-weight:600"><?php echo htmlspecialchars($p['name']); ?></div>
              <div class="price"><?php echo htmlspecialchars($p['price']); ?></div>
              <div style="margin-top:auto;display:flex;gap:8px;margin-top:10px">
                <a href="#" style="background:#e11d48;color:#fff;padding:8px 12px;border-radius:6px;text-decoration:none">Ajouter</a>
                <a href="#" style="align-self:center;color:#6b7280">Détails</a>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </section>
    </main>

    <footer>
      © <?php echo date('Y'); ?> Ma Boutique — Page PHP
    </footer>
  </div>
</body>
</html>
