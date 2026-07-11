<?php $title = 'Login'; ?>
<?php ob_start(); ?>

<link rel="stylesheet" href="/assets/css/login.css">
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

    <p class="auth-footnote">Ainda não és membro? <a href="contacte-nos.html">Inscrever-se</a></p>
  </div>
</section>

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

<?php $content = ob_get_clean(); ?>
<?php require __DIR__ . '/../layouts/publica.php'; ?>