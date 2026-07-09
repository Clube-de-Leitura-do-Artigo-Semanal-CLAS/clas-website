<?php $title = 'Eventos — CLAS'; ?>
<?php ob_start(); ?>

<section class="section section-bg">
  <div class="container">

    <div class="section-header">
      <div class="eyebrow">Agenda</div>
      <h2>Próximos eventos</h2>
      <p>Junte-se a nós nas nossas sessões semanais e eventos especiais. Descubra novas perspectivas através da leitura partilhada.</p>
    </div>

    <div class="events-toolbar">
      <div class="event-tabs">
        <button class="event-tab active" type="button">Próximos</button>
        <button class="event-tab" type="button">Passados</button>
      </div>

      <button class="category-select" type="button">
        Todas as categorias
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
      </button>
    </div>

    <!-- destaque -->
    <article class="event-featured">
      <div class="event-featured-media" aria-hidden="true"></div>
      <div class="event-featured-body">
        <div class="eyebrow">Destaque da semana</div>
        <h3>Sessão de cinema — CineMax</h3>

        <div class="event-meta">
          <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
          Sábado, 20 de Julho
        </div>
        <div class="event-meta">
          <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><polyline points="12 7 12 12 16 14"/></svg>
          10:00 — 13:00
        </div>
        <div class="event-meta">
          <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 12-9 12s-9-5-9-12a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
          Auditório Municipal de Lisboa
        </div>

        <p class="event-desc">Uma exploração cinematográfica dos temas abordados nos nossos artigos mensais. Após a exibição, teremos um painel de discussão com convidados especiais da área da literatura e artes visuais.</p>

        <a href="#" class="btn btn-primary">Inscrever-me</a>
      </div>
    </article>

    <!-- mais eventos -->
    <div class="more-events">
      <h2>Mais eventos na agenda</h2>

      <div class="event-grid">
        <article class="event-card">
          <div class="event-card-media"><span class="event-badge">Debate</span></div>
          <div class="event-card-body">
            <h4>Análise Crítica: "O Futuro da Edição"</h4>
            <div class="event-card-date">
              <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
              24 Julho, 2024
            </div>
            <a href="#" class="btn btn-outline btn-sm">Saber mais</a>
          </div>
        </article>

        <article class="event-card">
          <div class="event-card-media"><span class="event-badge">Concurso</span></div>
          <div class="event-card-body">
            <h4>Prémio de Ensaio CLAS</h4>
            <div class="event-card-date">
              <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
              15 Agosto, 2024
            </div>
            <a href="#" class="btn btn-outline btn-sm">Saber mais</a>
          </div>
        </article>

        <article class="event-card">
          <div class="event-card-media"><span class="event-badge">Debate</span></div>
          <div class="event-card-body">
            <h4>Análise Crítica: "O Futuro da Edição"</h4>
            <div class="event-card-date">
              <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
              24 Julho, 2024
            </div>
            <a href="#" class="btn btn-outline btn-sm">Saber mais</a>
          </div>
        </article>

        <article class="event-card">
          <div class="event-card-media"><span class="event-badge">Concurso</span></div>
          <div class="event-card-body">
            <h4>Prémio de Ensaio CLAS</h4>
            <div class="event-card-date">
              <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
              15 Agosto, 2024
            </div>
            <a href="#" class="btn btn-outline btn-sm">Saber mais</a>
          </div>
        </article>

        <article class="event-card">
          <div class="event-card-media"><span class="event-badge">Concurso</span></div>
          <div class="event-card-body">
            <h4>Prémio de Ensaio CLAS</h4>
            <div class="event-card-date">
              <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
              15 Agosto, 2024
            </div>
            <a href="#" class="btn btn-outline btn-sm">Saber mais</a>
          </div>
        </article>

        <article class="event-card">
          <div class="event-card-media"><span class="event-badge">Concurso</span></div>
          <div class="event-card-body">
            <h4>Prémio de Ensaio CLAS</h4>
            <div class="event-card-date">
              <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
              15 Agosto, 2024
            </div>
            <a href="#" class="btn btn-outline btn-sm">Saber mais</a>
          </div>
        </article>
      </div>

      <div class="load-more">
        <button class="btn btn-outline" type="button">Carregar mais eventos</button>
      </div>
    </div>

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

  document.querySelectorAll('.event-tab').forEach(tab => {
    tab.addEventListener('click', () => {
      document.querySelectorAll('.event-tab').forEach(t => t.classList.remove('active'));
      tab.classList.add('active');
    });
  });
</script>


<?php $content = ob_get_clean(); ?>
<?php require __DIR__ . '/../layouts/publica.php'; ?>
