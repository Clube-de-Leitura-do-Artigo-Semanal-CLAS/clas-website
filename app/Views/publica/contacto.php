<?php $title = 'Contacto — CLAS'; ?>
<?php ob_start(); ?>

<section class="section section-bg">
  <div class="container">
    <div class="section-header" style="text-align:center;">
      <h1 class="section-title">Contacto</h1>
      <p class="section-subtitle">Tens alguma dúvida? Fala connosco</p>
    </div>

    <div class="contacto-wrap">
      <form class="contacto-form" method="post" action="/contacto">
        <label>Nome
          <input type="text" name="nome" placeholder="O teu nome" required>
        </label>
        <label>Email
          <input type="email" name="email" placeholder="teu@email.ao" required>
        </label>
        <label>Mensagem
          <textarea name="mensagem" rows="4" placeholder="Escreve a tua mensagem..." required></textarea>
        </label>
        <button type="submit" class="btn btn-primary">Enviar mensagem</button>
      </form>

      <aside class="contacto-info">
        <h3>Informações</h3>
        <p><strong>Email</strong><br>artigosemanal.clas@gmail.com</p>
        <p><strong>Telefone</strong><br>+244 999 999 999</p>
        <p><strong>Localização</strong><br>Angola</p>
        <p><strong>Redes Sociais</strong><br>
          <a href="#" class="btn btn-secondary btn-sm">Facebook</a>
          <a href="#" class="btn btn-secondary btn-sm">Instagram</a>
        </p>
      </aside>
    </div>
  </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php require __DIR__ . '/../layouts/publica.php'; ?>
