<?php $title = 'CLAS — Clube de Leitura do Artigo Semanal'; ?>
<?php ob_start(); ?>

<section class="hero hero-bg">
  <div class="container hero-inner">
    <img src="/assets/img/logo_clas.png" class="img-hero" alt="">
    <!--<h1>O clube que<br>transforma</h1 >-->
    <p class="lead">Uma comunidade de leitura em Angola dedicada à exploração <br> literária e ao diálogo semanal.</p>

    <div class="hero-actions">
      <a href="/contacto" class="btn btn-primary-hero">Inscrever-se</a>
      <a href="/sobre" class="btn btn-secundary-hero">Saber mais sobre o CLAS</a>
    </div>
  </div>

  <div class=" hero-fan-wrap" aria-label="Colecção de livros em destaque">
    <div class="fan-stage">
      <div class="fan-card fan-card--1"><img src="/assets/img/capas/book-1.png" alt="Por Baixo da Capa" /></div>
      <div class="fan-card fan-card--2"><img src="/assets/img/capas/book-2.png" alt="Dragão de Cristal" /></div>
      <div class="fan-card fan-card--3"><img src="/assets/img/capas/book-3.png" alt="Está Chovendo Estrelas" /></div>
      <div class="fan-card fan-card--4"><img src="/assets/img/capas/book-4.png" alt="As Aventuras de Ngunga" /></div>
      <div class="fan-card fan-card--5"><img src="/assets/img/capas/book-5.png" alt="Terra Sonâmbula" /></div>
      <div class="fan-card fan-card--6"><img src="/assets/img/capas/book-6.png" alt="O Segredo nas Sombras" /></div>
      <div class="fan-card fan-card--7"><img src="/assets/img/capas/book-7.png" alt="É Assim que Acaba" /></div>
    </div>
  </div>
</section>

<section class="section section-bg" id="sobre">
  <div class="container">
    <div class="section-header">
      <div class="eyebrow">Quem somos</div>
      <h2>Sobre o Clube de Leitura do Artigo Semanal</h2>
      <p >Nascido da paixão pelo conhecimento e da necessidade de fomentar o pensamento crítico, o CLAS dedica-se a promover hábitos de leitura sólidos entre os jovens angolanos. Acreditamos que a discussão semanal de artigos seleccionados é o catalisador para uma sociedade mais informada, consciente e participativa.</p>
    </div>

    <div class="stats">
      <div class="stat-box">
        <div class="stat-num">100+</div>
        <div class="stat-label">Membros activos</div>
      </div>
      <div class="stat-box">
        <div class="stat-num">85%</div>
        <div class="stat-label">Taxa de presença</div>
      </div>
      <div class="stat-box">
        <div class="stat-num">12</div>
        <div class="stat-label">Meses de história</div>
      </div>
      <div class="stat-box">
        <div class="stat-num">500+</div>
        <div class="stat-label">Artigos lidos</div>
      </div>
    </div>

    <div class="mv-grid">
      <div class="mv-card">
        <h3>Missão</h3>
        <p>Nossa missão é democratizar o acesso a conteúdos académicos e de actualidade, criando um espaço seguro e estimulante onde jovens podem partilhar perspectivas, desafiar ideias e crescer intelectualmente através da análise rigorosa de artigos semanais.</p>
      </div>
      <div class="mv-card tilt">
        <h3>Visão</h3>
        <p>Ser a principal referência em Angola para comunidades de leitura e debate intelectual juvenil, expandindo o nosso alcance para todas as províncias e influenciando positivamente a trajectória académica e profissional dos nossos membros.</p>
      </div>
    </div>
  </div>
</section>


<section class="section section-bg" id="equipa" style="padding-top:0;">
  <div class="container">
    <div class="team-heading">
      <h2>Equipa da gestão</h2>
      <div class="rule"></div>
    </div>

    <div class="team-grid">
      <div class="team-card"><div class="team-avatar">RN</div><div class="team-name">Ricardo Neto</div><div class="team-role">Comunicação Digital</div></div>
      <div class="team-card"><div class="team-avatar">RN</div><div class="team-name">Ricardo Neto</div><div class="team-role">Comunicação Digital</div></div>
      <div class="team-card"><div class="team-avatar">RN</div><div class="team-name">Ricardo Neto</div><div class="team-role">Comunicação Digital</div></div>
      <div class="team-card"><div class="team-avatar">RN</div><div class="team-name">Ricardo Neto</div><div class="team-role">Comunicação Digital</div></div>
      <div class="team-card"><div class="team-avatar">RN</div><div class="team-name">Ricardo Neto</div><div class="team-role">Comunicação Digital</div></div>
      <div class="team-card"><div class="team-avatar">RN</div><div class="team-name">Ricardo Neto</div><div class="team-role">Comunicação Digital</div></div>
      <div class="team-card"><div class="team-avatar">RN</div><div class="team-name">Ricardo Neto</div><div class="team-role">Comunicação Digital</div></div>
      <div class="team-card"><div class="team-avatar">RN</div><div class="team-name">Ricardo Neto</div><div class="team-role">Comunicação Digital</div></div>
      <div class="team-card"><div class="team-avatar">RN</div><div class="team-name">Ricardo Neto</div><div class="team-role">Comunicação Digital</div></div>
      <div class="team-card"><div class="team-avatar">RN</div><div class="team-name">Ricardo Neto</div><div class="team-role">Comunicação Digital</div></div>
    </div>
  </div>
</section>


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

<section class="parceiros">

</section>

<?php $content = ob_get_clean(); ?>
<?php require __DIR__ . '/../layouts/publica.php'; ?>
