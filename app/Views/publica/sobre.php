<?php $title = 'Sobre — CLAS'; ?>
<?php ob_start(); ?>

<section class="section section-bg">
  <div class="container" style="max-width:820px;text-align:center;">
    <h1 class="section-title">Sobre o CLAS</h1>
    <div class="section-divider"></div>
    <p class="lead" style="font-style:italic;">
      O Clube de Leitura do Artigo Semanal (CLAS) é uma comunidade angolana
      dedicada à leitura, ao debate e ao crescimento intelectual.
    </p>
    <p>
      Reunimo-nos semanalmente para discutir artigos, livros e ideias que nos
      ajudam a pensar de forma crítica. Acreditamos que a leitura transforma vidas.
    </p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="sobre-cards">
      <div class="sobre-card">
        <h3>Missão</h3>
        <p>Promover a leitura e o debate como ferramentas de transformação pessoal e social.</p>
      </div>
      <div class="sobre-card">
        <h3>Visão</h3>
        <p>Ser referência em comunidades de leitura em Angola.</p>
      </div>
      <div class="sobre-card">
        <h3>Valores</h3>
        <p>Leitura, Debate, Respeito, Conhecimento e Comunidade.</p>
      </div>
    </div>
  </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php require __DIR__ . '/../layouts/publica.php'; ?>
