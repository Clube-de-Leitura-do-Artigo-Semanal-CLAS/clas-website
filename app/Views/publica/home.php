<?php $title = 'CLAS — Clube de Leitura do Artigo Semanal'; ?>
<?php ob_start(); ?>

<section class="hero-clas text-center">
  <div class="container position-relative">
    <img src="/assets/img/logo_clas1.png" alt="CLAS" class="hero-logo">
    <h1 class="fw-bold mb-3">Clube de Leitura do Artigo Semanal</h1>
    <p class="lead mb-5 fs-4 fst-italic opacity-75">Ler. Debater. Crescer.</p>
    <a href="/inscricao" class="btn btn-clas btn-lg px-5 py-3">Quero participar</a>
    <div class="mt-4">
      <a href="/sobre" class="text-white-50 text-decoration-none small fst-italic">Conhecer o CLAS &rarr;</a>
    </div>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="section-title d-inline-block">Porquê o CLAS?</h2>
      <p class="section-subtitle">Três pilares que nos definem</p>
    </div>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card card-clas h-100 p-4 text-center border-0">
          <div class="feature-icon"><i class="bi bi-book fs-4"></i></div>
          <h5 class="fw-bold mb-2">Leitura Semanal</h5>
          <p class="text-muted mb-0">Artigos selecionados para leitura e reflexão em comunidade, alimentando o hábito da leitura crítica.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-clas h-100 p-4 text-center border-0">
          <div class="feature-icon"><i class="bi bi-chat-dots fs-4"></i></div>
          <h5 class="fw-bold mb-2">Debates Semanais</h5>
          <p class="text-muted mb-0">Discussões presenciais e online com espaço para todas as vozes.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-clas h-100 p-4 text-center border-0">
          <div class="feature-icon"><i class="bi bi-graph-up-arrow fs-4"></i></div>
          <h5 class="fw-bold mb-2">Crescimento</h5>
          <p class="text-muted mb-0">Acompanhamento do teu histórico literário, troféus e evolução como leitor.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="py-5 text-center" style="background: rgba(30,74,122,0.04);">
  <div class="container">
    <h2 class="section-title d-inline-block">Próximos Eventos</h2>
    <p class="section-subtitle mb-4">Participa nos nossos encontros abertos à comunidade</p>
    <a href="/eventos" class="btn btn-clas px-5">Ver programação</a>
  </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php require __DIR__ . '/../layouts/publica.php'; ?>
