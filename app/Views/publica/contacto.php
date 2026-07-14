<?php $title = 'Contacto — CLAS'; ?>
<?php ob_start(); ?>

<section class="section section-bg" id="contacto">
  <div class="container">
    <div class="section-header">
      <div class="eyebrow">Fala connosco</div>
      <h2>Contacte-nos</h2>
      <p>Tem dúvidas sobre as nossas sessões semanais ou quer tornar-se membro? Estamos aqui para ouvir a sua perspectiva.</p>
    </div>

    <div class="contact-grid">
      <form class="contact-form" onsubmit="event.preventDefault(); alert('Formulário de exemplo — a ligar a um backend/serviço de e-mail.');">
        <div class="form-row">
          <div class="field">
            <label for="nome">Nome</label>
            <input type="text" id="nome" placeholder="O seu nome completo">
          </div>
          <div class="field">
            <label for="email">E-mail</label>
            <input type="email" id="email" placeholder="email@exemplo.com">
          </div>
        </div>
        <div class="form-row full">
          <div class="field">
            <label for="assunto">Assunto</label>
            <input type="text" id="assunto" placeholder="Em que podemos ajudar?">
          </div>
        </div>
        <div class="form-row full">
          <div class="field">
            <label for="mensagem">Mensagem</label>
            <textarea id="mensagem" placeholder="Escreva aqui a sua mensagem..."></textarea>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Enviar mensagem</button>
      </form>

      <div class="contact-side">
        <h3>Canais Diretos</h3>

        <div class="contact-channel">
          <div class="channel-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2D1F0E" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
          </div>
          <div>
            <div class="channel-label">Whatsapp da comunidade</div>
            <div class="channel-value">+244 923 000 000</div>
          </div>
        </div>

        <div class="contact-channel">
          <div class="channel-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2D1F0E" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 6-10 7L2 6"/></svg>
          </div>
          <div>
            <div class="channel-label">Email</div>
            <div class="channel-value">contacto@clas-artigo.ao</div>
          </div>
        </div>

        <div class="contact-channel">
          <div class="channel-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2D1F0E" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1"/></svg>
          </div>
          <div>
            <div class="channel-label">Instagram</div>
            <div class="channel-value">@clas.artigo.semanal</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php require __DIR__ . '/../layouts/publica.php'; ?>
