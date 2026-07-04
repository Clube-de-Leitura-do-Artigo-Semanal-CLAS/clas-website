<?php $title = 'Sobre — CLAS'; ?>
<?php ob_start(); ?>

<section class="py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 text-center">
        <h1 class="section-title d-inline-block">Sobre o CLAS</h1>
        <div class="section-divider"></div>
        <p class="lead fst-italic">O Clube de Leitura do Artigo Semanal (CLAS) é uma comunidade angolana dedicada à leitura, ao debate e ao crescimento intelectual.</p>
        <p>Reunimo-nos semanalmente para discutir artigos, livros e ideias que nos ajudam a pensar de forma crítica. Acreditamos que a leitura transforma vidas.</p>
      </div>
    </div>
  </div>
</section>

<section class="py-5" style="background: rgba(30,74,122,0.04);">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card card-clas h-100 p-5 text-center border-0">
          <div class="feature-icon mb-3"><i class="bi bi-globe2 fs-4"></i></div>
          <h4 class="fw-bold mb-2">Missão</h4>
          <p class="text-muted mb-0">Promover a leitura e o debate como ferramentas de transformação pessoal e social.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-clas h-100 p-5 text-center border-0">
          <div class="feature-icon mb-3"><i class="bi bi-eye fs-4"></i></div>
          <h4 class="fw-bold mb-2">Visão</h4>
          <p class="text-muted mb-0">Ser referência em comunidades de leitura em Angola.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-clas h-100 p-5 text-center border-0">
          <div class="feature-icon mb-3"><i class="bi bi-star fs-4"></i></div>
          <h4 class="fw-bold mb-2">Valores</h4>
          <p class="text-muted mb-0">Leitura, Debate, Respeito, Conhecimento e Comunidade.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php require __DIR__ . '/../layouts/publica.php'; ?>
