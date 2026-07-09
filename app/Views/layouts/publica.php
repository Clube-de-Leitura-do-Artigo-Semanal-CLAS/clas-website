<!DOCTYPE html>
<html lang="pt-AO">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>CLAS — Clube de Leitura do Artigo Semanal</title>
<link rel="icon" href="/assets/img/logo.gif" type="image/gif" />
<meta name="description" content="A maior plataforma angolana de livros, literatura e cultura. Descobre, lê e compra as melhores obras nacionais e internacionais." />
<meta name="keywords" content="livros Angola, literatura angolana, ebooks Angola, comprar livros, CLAS.AO" />
<meta property="og:title" content="CLAS.AO — Cultura, Leitura e Arte de Angola" />
<meta property="og:description" content="A maior plataforma angolana de livros, literatura e cultura." />
<meta property="og:type" content="website" />

<link rel="stylesheet" href="/assets/css/main.css">

</head>
<body>

<header class="site-header">
  <div class="nav-rigth nav">
    <a href="/" class="nav-logo">
      <img src="/assets/img/logo.gif" class="logo-img" alt="">
    </a>

    <nav class="nav-links">
      <a href="/sobre">Sobre o CLAS</a>
      <a href="/membros">Membros</a>
      <a href="/eventos">Eventos</a>
      <a href="/projetos">Projetos</a>
      <a href="/parceiros" class="nav-gap">Parceiros</a>
      <a href="/contacto">Contacte-nos</a>
    </nav>

    <div class="nav-right">
      <a href="/login" class="btn btn-primary login  " >Login</a>
      <button class="nav-toggle" id="navToggle" aria-label="Abrir menu" aria-expanded="false">
        <svg class="icon-open" xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#1A1008" stroke-width="2.2" stroke-linecap="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
        <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#1A1008" stroke-width="2.2" stroke-linecap="round"><line x1="6" y1="6" x2="18" y2="18"/><line x1="18" y1="6" x2="6" y2="18"/></svg>
      </button>
    </div>
  </div>

  <div class="mobile-menu" id="mobileMenu">
    <div class="container mobile-menu-inner">
      <a href="/">Home</a>
      <a href="/eventos">Eventos</a>
      <a href="/sobre">Sobre o CLAS</a>
      <a href="/membros">Membros</a>
      <a href="galeria.html">Galeria</a>
      <a href="/contacto">Contacte-nos</a>
      <a href="/login" class="btn btn-primary">Login</a>
    </div>
  </div>
</header>

<main>
  <?= $content ?? '' ?>
</main>

<footer class="site-footer section-bg">
  <div class="container">
    <span class="footer-logo">
      <img src="/assets/img/logo.gif" class="logo-img" alt="">
    </span>
    <span class="footer-copy">© 2026 Clube de Leitura do Artigo Semanal. Todos os direitos reservados.</span>
  </div>
</footer>

<script>
  const toggle = document.getElementById('navToggle');
  const menu = document.getElementById('mobileMenu');
  toggle.addEventListener('click', () => {
    const isOpen = menu.classList.toggle('is-open');
    toggle.classList.toggle('is-open', isOpen);
    toggle.setAttribute('aria-expanded', isOpen);
  });
  document.querySelectorAll('.mobile-menu-inner a').forEach(a => a.addEventListener('click', () => {
    menu.classList.remove('is-open');
    toggle.classList.remove('is-open');
    toggle.setAttribute('aria-expanded', false);
  }));


  const header = document.querySelector(".site-header");

  window.addEventListener("scroll", () => {
    if (window.scrollY > 40) {
        header.classList.add("scrolled");
    } else {
        header.classList.remove("scrolled");
    }
});
</script>

</body>
</html>
