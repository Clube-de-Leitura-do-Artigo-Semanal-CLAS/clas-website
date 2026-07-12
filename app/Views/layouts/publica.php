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
<link rel="stylesheet" href="/assets/css/membros.css">
</head>
<body>

<header class="site-header">
  <div class="nav-rigth nav">
    <a href="/" class="nav-logo">
      <img src="/assets/img/logo.gif" class="logo-img" alt="">
    </a>

    <nav class="nav-links">
      <a href="/#sobre">Sobre o CLAS</a>
      <a href="/membros">Membros</a>
      <a href="/eventos">Eventos</a>
      <a href="/contacto" class="nav-gap">Contacte-nos</a>
    </nav>

    <div class="nav-right">
      <a href="/login" class="btn btn-primary login" >Login</a>
      <button class="nav-toggle" id="navToggle" aria-label="Abrir menu" aria-expanded="false">
        <svg class="icon-open" xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#1A1008" stroke-width="2.2" stroke-linecap="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
        <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#1A1008" stroke-width="2.2" stroke-linecap="round"><line x1="6" y1="6" x2="18" y2="18"/><line x1="18" y1="6" x2="6" y2="18"/></svg>
      </button>
    </div>
  </div>

  <div class="mobile-menu" id="mobileMenu">
    <div class="container mobile-menu-inner">
      <a href="/#sobre">Sobre o CLAS</a>
      <a href="/membros">Membros</a>
      <a href="/eventos">Eventos</a>
      <a href="/contacto" class="nav-gap">Contacte-nos</a>
      <a href="/login" class="btn btn-primary login" >Login</a>
    </div>

  </div>
  </div>
</header>

<main>
  <?= $content ?? '' ?>
</main>

<footer class="site-footer section-bg">
  <div class="container">

    <div class="footer-grid">

      <div class="footer-brand">
        <span class="footer-logo">
          <img src="/assets/img/logo.gif" class="logo-img" alt="">
        </span>
        <p>
          O Clube de Leitura do Artigo Semanal é uma comunidade angolana
          dedicada à leitura, à discussão de ideias e à promoção da cultura
          literária em Luanda e além.
        </p>
        <div class="footer-social">
          <!-- TODO: substituir "#" pelos links reais das redes sociais do CLAS -->
          <a href="#" aria-label="Instagram">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1"/></svg>
          </a>
          <a href="#" aria-label="Facebook">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M15 8h2V5h-2a4 4 0 0 0-4 4v3H9v3h2v6h3v-6h2.5l.5-3H14V9a1 1 0 0 1 1-1Z"/></svg>
          </a>
          <a href="#" aria-label="WhatsApp">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 12a8 8 0 1 1-3.5-6.6"/><path d="M20 12 12 12 12 4"/></svg>
          </a>
        </div>
      </div>

      <div class="footer-col">
        <h4>Navegação</h4>
        <ul>
          <li><a href="/">Home</a></li>
          <li><a href="/#sobre">Sobre o CLAS</a></li>
          <li><a href="/eventos">Eventos</a></li>
          <li><a href="/membros">Membros</a></li>
          <li><a href="/contacto">Contacte-nos</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h4>Comunidade</h4>
        <ul>
          <!-- TODO: ajustar/adicionar estas ligações consoante as páginas reais -->
          <li><a href="/login">Iniciar sessão</a></li>
          <li><a href="/eventos">Próximos eventos</a></li>
          <li><a href="/membros">Ranking de membros</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h4>Contacto</h4>
        <div class="footer-location">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
          <!-- TODO: confirmar morada exacta -->
          <span>Luanda, Angola</span>
        </div>
        <ul style="margin-top:14px;">
          <!-- TODO: substituir pelo email/telefone reais -->
          <li><a href="mailto:geral@clas.ao">geral@clas.ao</a></li>
          <li><a href="tel:+244900000000">+244 900 000 000</a></li>
        </ul>
      </div>

    </div>

    <div class="footer-bottom">
      <span class="footer-copy">© 2026 Clube de Leitura do Artigo Semanal. Todos os direitos reservados.</span>
      <div class="footer-bottom-links">
        <a href="/privacidade">Privacidade</a>
        <a href="/termos">Termos de uso</a>
      </div>
    </div>

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