<!DOCTYPE html>
<html lang="pt-AO">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Entrar no CLAS</title>
<meta name="description" content="Acede à tua área de membro do CLAS.">
<link rel="stylesheet" href="/assets/css/entrar.css">
</head>
<body>


<header class="site-header">
  <div class="container nav">
    <a href="/" class="nav-logo">
      <img src="/assets/img/logo.gif" class="logo-img" alt="">
    </a>

    <nav class="nav-links">
      <a href="#sobre.html">Sobre o CLAS</a>
      <a href="/membros">Membros</a>
      <a href="/eventos">Eventos</a>
      <a href="projetos.html">Projetos</a>
      <a href="parceiros" class="nav-gap">Parceiros</a>
      <a href="#contacte-nos.html">Contacte-nos</a>
    </nav>

    <div style="display:flex; align-items:center; gap:10px;">
      <a href="/login" class="btn btn-primary nav-cta">Login</a>
      <button class="nav-toggle" id="navToggle" aria-label="Abrir menu" aria-expanded="false">
        <svg class="icon-open" xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#1A1008" stroke-width="2.2" stroke-linecap="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
        <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#1A1008" stroke-width="2.2" stroke-linecap="round"><line x1="6" y1="6" x2="18" y2="18"/><line x1="18" y1="6" x2="6" y2="18"/></svg>
      </button>
    </div>
  </div>

  <div class="mobile-menu" id="mobileMenu">
    <div class="container mobile-menu-inner">
      <a href="/">Home</a>
      <a href="/sobre">Sobre o CLAS</a>
      <a href="/membros">Membros</a>
      <a href="/eventos">Eventos</a>
      <a href="/contacto">Contacte-nos</a>
      <a href="/login" class="btn btn-primary">Login</a>
    </div>
  </div>
</header>


<section class="auth-section section-bg">
  <div class="container auth-wrap">
    <div class="auth-card">
      <div class="auth-visual" aria-hidden="true"></div>

      <div class="auth-form">
        <h1>Entrar no CLAS</h1>
        <p class="auth-sub">Acede à tua área de membro</p>

        <form onsubmit="event.preventDefault(); alert('Formulário de exemplo — a ligar à autenticação real.');">
          <div class="field">
            <label for="login-email">E-mail</label>
            <input type="email" id="login-email" placeholder="exemplo@email.com">
          </div>

          <div class="field" style="margin-bottom:0;">
            <label for="login-pass">Palavra-passe</label>
            <input type="password" id="login-pass" placeholder="••••••••">
          </div>
          <a href="#" class="forgot-link">Esqueci-me da password</a>

          <button type="submit" class="btn btn-primary">Entrar</button>
        </form>

        <div class="auth-divider">ou</div>

        <button type="button" class="btn btn-outline btn-qr" onclick="alert('Abrir leitor de QR code — a ligar à câmara/scanner.');">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><line x1="14" y1="14" x2="14" y2="21"/><line x1="21" y1="14" x2="21" y2="21"/><line x1="14" y1="17.5" x2="21" y2="17.5"/></svg>
          Ler QR code do passe
        </button>
      </div>
    </div>

    <p class="auth-footnote">Ainda não és membro? <a href="/contacto">Inscrever-se</a></p>
  </div>
</section>


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
</script>

</body>
</html>
