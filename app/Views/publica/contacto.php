<?php $title = 'Contacto — CLAS'; ?>
<?php ob_start(); ?>

<section class="py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h1 class="section-title d-inline-block">Contacto</h1>
      <p class="section-subtitle">Tens alguma dúvida? Fala connosco</p>
    </div>
    <div class="row justify-content-center g-5">
      <div class="col-lg-5">
        <form>
          <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" class="form-control" placeholder="O teu nome" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" placeholder="teu@email.ao" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Mensagem</label>
            <textarea class="form-control" rows="4" placeholder="Escreve a tua mensagem..." required></textarea>
          </div>
          <button type="submit" class="btn btn-clas w-100">Enviar mensagem</button>
        </form>
      </div>
      <div class="col-lg-4">
        <div class="card card-clas p-5 border-0">
          <h5 class="fw-bold mb-4" style="font-family: 'Playfair Display', serif;">Informações</h5>
          <p class="mb-3">
            <strong style="color: var(--clas-blue);">Email</strong><br>
            artigosemanal.clas@gmail.com
          </p>
          <p class="mb-3">
            <strong style="color: var(--clas-blue);">Telefone</strong><br>
            +244 999 999 999
          </p>
          <p class="mb-3">
            <strong style="color: var(--clas-blue);">Localização</strong><br>
            Angola
          </p>
          <p class="mb-0">
            <strong style="color: var(--clas-blue);">Redes Sociais</strong><br>
            <a href="#" class="btn btn-clas-outline btn-sm mt-2"><i class="bi bi-facebook me-1"></i>Facebook</a>
            <a href="#" class="btn btn-clas-outline btn-sm mt-2"><i class="bi bi-instagram me-1"></i>Instagram</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php require __DIR__ . '/../layouts/publica.php'; ?>
