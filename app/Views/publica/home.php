<?php $title = 'CLAS — Clube de Leitura do Artigo Semanal'; ?>
<?php ob_start(); ?>

<section id="home" class="relative pt-10 md:pt-16 pb-0 overflow-hidden">
    <div class="max-w-4xl mx-auto px-6 text-center">
      <h1 class="reveal reveal-1 font-serif font-black uppercase leading-[0.98] text-[13vw] sm:text-6xl md:text-7xl lg:text-[80px] tracking-tight">
        O clube que<br>transforma
      </h1>
      <p class="reveal reveal-2 mt-6 md:mt-7 text-muted text-[15px] md:text-base max-w-md mx-auto leading-relaxed">
        Uma comunidade de leitura em Angola dedicada à exploração literária e ao diálogo semanal.
      </p>

      <div class="reveal reveal-3 mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
        <a href="#contacto" class="btn btn-primary-hero">
          INSCREVER-SE
        </a>
        <a href="#sobre" class="btn btn-secundary-hero">
          SABER MAIS SOBRE O CLAS
        </a>
      </div>
    </div>

    <!-- Fan of cards -->
    <div class="reveal reveal-4 hero-fan-wrap" aria-label="Colecção de livros em destaque">

      <div class="fan-stage">
        <div class="fan-card fan-card--1"><img src="../../public/assests/img/capas/book-2.png" alt="Por Baixo da Capa" /></div>
        <div class="fan-card fan-card--2"><img src="../../public/assests/img/capas/book-2.png" alt="Dragão de Cristal" /></div>
        <div class="fan-card fan-card--3"><img src="../../public/assests/img/capas/book-3.png" alt="Está Chovendo Estrelas" /></div>
        <div class="fan-card fan-card--4"><img src="../../public/assests/img/capas/book-4.png" alt="As Aventuras de Ngunga" /></div>
        <div class="fan-card fan-card--5"><img src="../../public/assests/img/capas/book-6.png" alt="O Segredo nas Sombras" /></div>
        <div class="fan-card fan-card--7"><img src="../../public/assests/img/capas/book-7.png" alt="É Assim que Acaba" /></div>
      </div>
    </div>

</section>


<div class="papel-bg">
  
  <section id="sobre" class="relative pt-24 md:pt-32 pb-20 md:pb-28">
    <div class="max-w-5xl mx-auto px-6 border-t border-dashed border-ink/25 pt-14 md:pt-16 text-center">
      <p class="text-[12px] tracking-[0.2em] font-semibold text-muted mb-4">QUEM SOMOS</p>
      <h2 class="font-serif font-bold text-3xl md:text-[42px] leading-tight max-w-2xl mx-auto">
        Sobre o Clube de Leitura do Artigo Semanal
      </h2>
      <p class="mt-6 text-muted text-[15px] md:text-[16px] leading-relaxed max-w-2xl mx-auto">
        Nascido da paixão pelo conhecimento e da necessidade de fomentar o pensamento crítico, o CLAS dedica-se a promover hábitos de leitura sólidos entre os jovens angolanos. Acreditamos que a discussão semanal de artigos seleccionados é o catalisador para uma sociedade mais informada, consciente e participativa.
      </p>

      <!-- Stats -->
      <div class="mt-14 grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
        <div class="stat-card">
          <p class="font-serif font-bold text-3xl md:text-4xl">100+</p>
          <p class="mt-2 text-[11px] tracking-wide font-medium text-muted">MEMBROS ACTIVOS</p>
        </div>
        <div class="stat-card">
          <p class="font-serif font-bold text-3xl md:text-4xl">85%</p>
          <p class="mt-2 text-[11px] tracking-wide font-medium text-muted">TAXA DE PRESENÇA</p>
        </div>
        <div class="stat-card">
          <p class="font-serif font-bold text-3xl md:text-4xl">12</p>
          <p class="mt-2 text-[11px] tracking-wide font-medium text-muted">MESES DE HISTÓRIA</p>
        </div>
        <div class="stat-card">
          <p class="font-serif font-bold text-3xl md:text-4xl">500+</p>
          <p class="mt-2 text-[11px] tracking-wide font-medium text-muted">ARTIGOS LIDOS</p>
        </div>
      </div>

      <!-- Missão / Visão -->
      <div class="mt-14 md:mt-16 grid md:grid-cols-2 gap-8 md:gap-10 text-left">
        <div class="note-card rotate-note-left">
          <span class="dot"></span>
          <h3 class="font-serif font-bold text-xl md:text-2xl mb-3">Missão</h3>
          <p class="text-muted text-[14px] md:text-[15px] leading-relaxed">
            Nossa missão é democratizar o acesso a conteúdos académicos e de actualidade, criando um espaço seguro e estimulante onde jovens podem partilhar perspectivas, desafiar ideias e crescer intelectualmente através da análise rigorosa de artigos semanais.
          </p>
        </div>
        <div class="note-card rotate-note-right">
          <span class="dot"></span>
          <h3 class="font-serif font-bold text-xl md:text-2xl mb-3">Visão</h3>
          <p class="text-muted text-[14px] md:text-[15px] leading-relaxed">
            Ser a principal referência em Angola para comunidades de leitura e debate intelectual juvenil, expandindo o nosso alcance para todas as províncias e influenciando positivamente a trajectória académica e profissional dos nossos membros.
          </p>
        </div>
      </div>
    </div>
  </section>

  
  <section id="equipa" class="relative pb-20 md:pb-28">
    <div class="max-w-6xl mx-auto px-6">
      <div class="flex items-center gap-6 mb-10 md:mb-12">
        <h3 class="font-serif font-bold text-xl md:text-2xl whitespace-nowrap uppercase tracking-wide">Equipa da Gestão</h3>
        <span class="h-px bg-ink/20 w-full"></span>
      </div>

      <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 md:gap-5">
        <!-- Team card x10 -->
        <div class="team-card"><span class="avatar">RN</span><p class="name">Ricardo Neto</p><p class="role">Comunicação Digital</p></div>
        <div class="team-card"><span class="avatar">RN</span><p class="name">Ricardo Neto</p><p class="role">Comunicação Digital</p></div>
        <div class="team-card"><span class="avatar">RN</span><p class="name">Ricardo Neto</p><p class="role">Comunicação Digital</p></div>
        <div class="team-card"><span class="avatar">RN</span><p class="name">Ricardo Neto</p><p class="role">Comunicação Digital</p></div>
        <div class="team-card"><span class="avatar">RN</span><p class="name">Ricardo Neto</p><p class="role">Comunicação Digital</p></div>
        <div class="team-card"><span class="avatar">RN</span><p class="name">Ricardo Neto</p><p class="role">Comunicação Digital</p></div>
        <div class="team-card"><span class="avatar">RN</span><p class="name">Ricardo Neto</p><p class="role">Comunicação Digital</p></div>
        <div class="team-card"><span class="avatar">RN</span><p class="name">Ricardo Neto</p><p class="role">Comunicação Digital</p></div>
        <div class="team-card"><span class="avatar">RN</span><p class="name">Ricardo Neto</p><p class="role">Comunicação Digital</p></div>
        <div class="team-card"><span class="avatar">RN</span><p class="name">Ricardo Neto</p><p class="role">Comunicação Digital</p></div>
      </div>
    </div>
  </section>
</div> 

<div class="papel-bg">
  <section id="contacto" class="relative pt-20 md:pt-28 pb-20 md:pb-28">
    <div class="max-w-5xl mx-auto px-6 text-center">
      <p class="text-[12px] tracking-[0.2em] font-semibold text-muted mb-4">FALA CONNOSCO</p>
      <h2 class="font-serif font-bold text-3xl md:text-[42px] leading-tight">Contacte-nos</h2>
      <p class="mt-4 text-muted text-[15px] md:text-[16px] leading-relaxed max-w-lg mx-auto">
        Tem dúvidas sobre as nossas sessões semanais ou quer tornar-se membro? Estamos aqui para ouvir a sua perspectiva.
      </p>
    </div>

    <div class="max-w-5xl mx-auto px-6 mt-12 grid lg:grid-cols-[1.4fr_1fr] gap-8 md:gap-10 text-left">
      <!-- Form -->
      <form class="contact-card">
        <div class="grid sm:grid-cols-2 gap-5">
          <div>
            <label class="field-label">Nome</label>
            <input type="text" placeholder="O seu nome completo" class="field-input">
          </div>
          <div>
            <label class="field-label">E-mail</label>
            <input type="email" placeholder="email@exemplo.com" class="field-input">
          </div>
        </div>
        <div class="mt-5">
          <label class="field-label">Assunto</label>
          <input type="text" placeholder="Em que podemos ajudar?" class="field-input">
        </div>
        <div class="mt-5">
          <label class="field-label">Mensagem</label>
          <textarea rows="5" placeholder="Escreva aqui a sua mensagem..." class="field-input resize-none"></textarea>
        </div>
        <button type="submit" class="btn btn-accent mt-6 w-full">
          Enviar mensagem
        </button>
      </form>


      <div class="pt-2">
        <h3 class="font-serif font-bold text-xl md:text-2xl mb-6 pb-4 border-b border-ink/15">Canais Diretos</h3>

        <div class="flex items-start gap-4 mb-6">
          <span class="icon-badge">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
          </span>
          <div>
            <p class="text-[11px] tracking-wide font-semibold text-muted">WHATSAPP DA COMUNIDADE</p>
            <p class="text-[15px] mt-0.5">+244 923 000 000</p>
          </div>
        </div>

        <div class="flex items-start gap-4 mb-6">
          <span class="icon-badge">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M4 4h16v16H4z" stroke="none"/><path d="M22 6 12 13 2 6"/><rect x="2" y="4" width="20" height="16" rx="2"/></svg>
          </span>
          <div>
            <p class="text-[11px] tracking-wide font-semibold text-muted">EMAIL</p>
            <p class="text-[15px] mt-0.5">contacto@clas-artigo.ao</p>
          </div>
        </div>

        <div class="flex items-start gap-4">
          <span class="icon-badge">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="0.6" fill="currentColor"/></svg>
          </span>
          <div>
            <p class="text-[11px] tracking-wide font-semibold text-muted">INSTAGRAM</p>
            <p class="text-[15px] mt-0.5">@clas.artigo.semanal</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>


<?php $content = ob_get_clean(); ?>
<?php require __DIR__ . '/../layouts/publica.php'; ?>
