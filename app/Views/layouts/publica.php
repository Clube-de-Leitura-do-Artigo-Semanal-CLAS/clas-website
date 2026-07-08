<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CLAS — Clube de Leitura do Artigo Semanal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="/assets/css/clas.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-clas">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-3" href="/">
      <img src="/assets/img/logo_clas1.png" alt="CLAS">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-lg-center">
        <li class="nav-item"><a class="nav-link" href="/sobre">Sobre</a></li>
        <li class="nav-item"><a class="nav-link" href="/eventos">Eventos</a></li>
        <li class="nav-item"><a class="nav-link" href="/concurso-mwangole">MwangoLê</a></li>
        <li class="nav-item"><a class="nav-link" href="/contacto">Contacto</a></li>
        <li class="nav-item ms-lg-3">
          <a class="btn btn-clas btn-sm px-4" href="/login">Login</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<main>
  <?= $content ?? '' ?>
</main>

<footer class="footer-clas py-5">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-5">
        <img src="/assets/img/logo_clas1.png" alt="CLAS" class="footer-logo mb-3">
        <p class="small" style="max-width: 340px;">Clube de Leitura do Artigo Semanal — promovendo a leitura, o debate e o conhecimento em Angola.</p>
      </div>
      <div class="col-md-3">
        <h5 class="fw-bold mb-3 small text-uppercase tracking-wider" style="letter-spacing: 1px; color: var(--clas-yellow);">Navegar</h5>
        <ul class="list-unstyled small">
          <li class="mb-2"><a href="/sobre">Sobre nós</a></li>
          <li class="mb-2"><a href="/eventos">Eventos</a></li>
          <li class="mb-2"><a href="/contacto">Contacto</a></li>
          <li class="mb-2"><a href="/inscricao">Inscrever-se</a></li>
        </ul>
      </div>
      <div class="col-md-4">
        <h5 class="fw-bold mb-3 small text-uppercase tracking-wider" style="letter-spacing: 1px; color: var(--clas-yellow);">Contacto</h5>
        <ul class="list-unstyled small">
          <li class="mb-2">Email: artigosemanal.clas@gmail.com</li>
          <li class="mb-2">Angola</li>
        </ul>
      </div>
    </div>
    <hr class="border-light opacity-25 my-4">
    <div class="text-center small opacity-75">
      &copy; 2026 CLAS — Clube de Leitura do Artigo Semanal
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
