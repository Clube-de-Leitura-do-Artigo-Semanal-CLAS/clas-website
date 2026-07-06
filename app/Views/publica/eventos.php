<?php $title = 'Eventos — CLAS'; ?>
<?php ob_start(); ?>

<section class="py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h1 class="section-title d-inline-block">Eventos Públicos</h1>
      <p class="section-subtitle">Atividades abertas à comunidade — participa connosco</p>
    </div>

    <div class="row g-4">
      <div class="col-md-6 col-lg-4">
        <div class="card card-clas h-100">
          <div class="card-header"><i class="bi bi-building me-2"></i>Visita ao Museu Nacional</div>
          <div class="card-body d-flex flex-column">
            <p class="text-muted small mb-3">Passeio cultural guiado com transporte de ida e volta.</p>
            <div class="d-flex flex-column gap-1 small text-muted mb-3">
              <span><i class="bi bi-calendar3 me-2"></i>15 de Agosto de 2026</span>
              <span><i class="bi bi-clock me-2"></i>09h00 — 12h00</span>
              <span><i class="bi bi-geo-alt me-2"></i>Museu Nacional, Luanda</span>
            </div>
            <div class="bg-light rounded-3 p-3 mb-3">
              <p class="fw-bold mb-2 small">Investimento</p>
              <p class="mb-1 small"><i class="bi bi-check-circle text-success me-1"></i>Transporte: 3.500 KZ</p>
              <p class="mb-1 small"><i class="bi bi-check-circle text-success me-1"></i>Entrada: 1.000 KZ</p>
              <p class="mb-0 small"><i class="bi bi-check-circle text-success me-1"></i>Guia e coffee break</p>
            </div>
            <button type="button" class="btn btn-clas mt-auto w-100" data-bs-toggle="modal" data-bs-target="#modalMuseu">
              <i class="bi bi-whatsapp me-2"></i>Estou interessado
            </button>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="card card-clas h-100">
          <div class="card-header"><i class="bi bi-book me-2"></i>Feira do Livro</div>
          <div class="card-body d-flex flex-column">
            <p class="text-muted small mb-3">Feira aberta ao público com editoras, palestras e autógrafos.</p>
            <div class="d-flex flex-column gap-1 small text-muted mb-3">
              <span><i class="bi bi-calendar3 me-2"></i>22 de Agosto de 2026</span>
              <span><i class="bi bi-clock me-2"></i>10h00 — 17h00</span>
              <span><i class="bi bi-geo-alt me-2"></i>Pavilhão do Kilamba</span>
            </div>
            <div class="bg-light rounded-3 p-3 mb-3">
              <p class="fw-bold mb-2 small">Entrada</p>
              <p class="mb-0 small"><i class="bi bi-check-circle text-success me-1"></i>Gratuita — aberto ao público</p>
            </div>
            <button type="button" class="btn btn-clas mt-auto w-100" data-bs-toggle="modal" data-bs-target="#modalFeira">
              <i class="bi bi-whatsapp me-2"></i>Estou interessado
            </button>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="card card-clas h-100">
          <div class="card-header"><i class="bi bi-journal-text me-2"></i>Workshop de Escrita</div>
          <div class="card-body d-flex flex-column">
            <p class="text-muted small mb-3">Oficina prática com escritores convidados.</p>
            <div class="d-flex flex-column gap-1 small text-muted mb-3">
              <span><i class="bi bi-calendar3 me-2"></i>5 de Setembro de 2026</span>
              <span><i class="bi bi-clock me-2"></i>14h00 — 17h00</span>
              <span><i class="bi bi-geo-alt me-2"></i>Biblioteca Provincial</span>
            </div>
            <div class="bg-light rounded-3 p-3 mb-3">
              <p class="fw-bold mb-2 small">Investimento</p>
              <p class="mb-1 small"><i class="bi bi-check-circle text-success me-1"></i>Workshop: 2.000 KZ</p>
              <p class="mb-0 small"><i class="bi bi-check-circle text-success me-1"></i>Material didático incluído</p>
            </div>
            <button type="button" class="btn btn-clas mt-auto w-100" data-bs-toggle="modal" data-bs-target="#modalWorkshop">
              <i class="bi bi-whatsapp me-2"></i>Estou interessado
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Modals -->
<div class="modal fade" id="modalMuseu" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="bi bi-building me-2"></i>Visita ao Museu Nacional</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="https://wa.me/244999999999" method="get" target="_blank">
        <div class="modal-body">
          <input type="hidden" name="text" id="msg-museu">
          <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome-museu" placeholder="O teu nome" required>
          </div>
          <div class="mb-3">
            <label class="form-label">WhatsApp</label>
            <input type="tel" class="form-control" id="whatsapp-museu" placeholder="+244 900 000 000" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Mensagem (opcional)</label>
            <textarea class="form-control" id="msg-museu-texto" rows="2" placeholder="Alguma pergunta?"></textarea>
          </div>
          <div class="small text-muted">
            <i class="bi bi-info-circle me-1"></i>Transporte 3.500 KZ + Entrada 1.000 KZ
          </div>
        </div>
        <div class="modal-footer border-0 pt-0">
          <button type="submit" class="btn btn-clas w-100">
            <i class="bi bi-whatsapp me-2"></i>Enviar pelo WhatsApp
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalFeira" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="bi bi-book me-2"></i>Feira do Livro</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="https://wa.me/244999999999" method="get" target="_blank">
        <div class="modal-body">
          <input type="hidden" name="text" id="msg-feira">
          <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome-feira" placeholder="O teu nome" required>
          </div>
          <div class="mb-3">
            <label class="form-label">WhatsApp</label>
            <input type="tel" class="form-control" id="whatsapp-feira" placeholder="+244 900 000 000" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Mensagem (opcional)</label>
            <textarea class="form-control" id="msg-feira-texto" rows="2" placeholder="Alguma pergunta?"></textarea>
          </div>
          <div class="small text-muted">
            <i class="bi bi-info-circle me-1"></i>Evento gratuito — entrada livre
          </div>
        </div>
        <div class="modal-footer border-0 pt-0">
          <button type="submit" class="btn btn-clas w-100">
            <i class="bi bi-whatsapp me-2"></i>Enviar pelo WhatsApp
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalWorkshop" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="bi bi-journal-text me-2"></i>Workshop de Escrita</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="https://wa.me/244999999999" method="get" target="_blank">
        <div class="modal-body">
          <input type="hidden" name="text" id="msg-workshop">
          <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome-workshop" placeholder="O teu nome" required>
          </div>
          <div class="mb-3">
            <label class="form-label">WhatsApp</label>
            <input type="tel" class="form-control" id="whatsapp-workshop" placeholder="+244 900 000 000" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Mensagem (opcional)</label>
            <textarea class="form-control" id="msg-workshop-texto" rows="2" placeholder="Alguma pergunta?"></textarea>
          </div>
          <div class="small text-muted">
            <i class="bi bi-info-circle me-1"></i>Valor: 2.000 KZ — material incluído
          </div>
        </div>
        <div class="modal-footer border-0 pt-0">
          <button type="submit" class="btn btn-clas w-100">
            <i class="bi bi-whatsapp me-2"></i>Enviar pelo WhatsApp
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
(function() {
  function setupModal(modalId, nomeId, whatsappId, eventoNome, msgTextoId) {
    var form = document.querySelector('#' + modalId + ' form');
    if (!form) return;
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      var nome = document.getElementById(nomeId).value;
      var whatsapp = document.getElementById(whatsappId).value;
      var msgExtra = document.getElementById(msgTextoId).value;
      var texto = 'Olá! Tenho interesse no evento: ' + eventoNome + '. Meu nome é ' + nome + ', WhatsApp: ' + whatsapp;
      if (msgExtra) texto += '. ' + msgExtra;
      var url = 'https://wa.me/244999999999?text=' + encodeURIComponent(texto);
      window.open(url, '_blank');
    });
  }
  setupModal('modalMuseu', 'nome-museu', 'whatsapp-museu', 'Visita ao Museu Nacional', 'msg-museu-texto');
  setupModal('modalFeira', 'nome-feira', 'whatsapp-feira', 'Feira do Livro', 'msg-feira-texto');
  setupModal('modalWorkshop', 'nome-workshop', 'whatsapp-workshop', 'Workshop de Escrita Criativa', 'msg-workshop-texto');
})();
</script>

<?php $content = ob_get_clean(); ?>
<?php require __DIR__ . '/../layouts/publica.php'; ?>
