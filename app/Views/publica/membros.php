<?php $title = 'Membros — CLAS'; ?>
<?php ob_start(); ?>

<link rel="stylesheet" href="/assets/css/membros.css">

<section class="section section-bg" style="padding-top: 60px; background-size: cover; background-position: center; background-repeat: no-repeat;">
  <div class="container">

    <!-- Header -->
    <div class="section-header" style="margin-bottom: 100px;">
      <div class="eyebrow">Liga CLAS</div>
      <h1>Pódio da semana</h1>
      <p>Ranking semanal baseado nos pontos dos quizzes e participação da nossa comunidade literária.</p>
    </div>

    <!-- Pódio (top 3) -->
    <div class="podium" style="padding-top: 60px">
      <?php
        // Reordena para o layout visual: 2º, 1º (líder ao centro), 3º
        $ranksPodio = [2, 1, 3];
        $ordemPodio = [$top3[1] ?? null, $top3[0] ?? null, $top3[2] ?? null];
        foreach ($ordemPodio as $i => $m):
          if (!$m) continue;
          $rank = $ranksPodio[$i];
          $isLeader = $rank === 1;
      ?>
        <a href="/membro/<?= $m['numero_processo'] ?>" class="podium-card<?= $isLeader ? ' leader' : '' ?>">
          <?php if ($isLeader): ?>
            <div class="podium-trophy"><i class="bi bi-trophy-fill"></i></div>
          <?php endif; ?>
          <div class="podium-avatar"></div>
          <div class="podium-rank"><?= $isLeader ? '#1 LÍDER' : '#' . $rank ?></div>
          <div class="podium-name"><?= $m['nome_passe'] ?></div>
          <div class="podium-pts"><?= $m['leituras'] ?><span>PTS</span></div>
        </a>
      <?php endforeach; ?>
    </div>

    <!-- Pesquisa e ordenação (funcionalidade mantida, não está no Figma mas era tua) -->
    <div style="display:flex; gap:12px; flex-wrap:wrap; align-items:center; max-width:920px; margin:0 auto 20px;">
      <div style="position:relative; flex:1; min-width:200px; max-width:400px;">
        <i class="bi bi-search" style="position:absolute; left:14px; top:50%; transform:translateY(-50%); color:var(--clr-muted); font-size:.9rem;"></i>
        <input
          id="searchMembro"
          type="text"
          placeholder="Pesquisar por nome ou ID..."
          oninput="filtrarMembros(this.value)"
          style="width:100%; height:46px; border:1.5px solid var(--clr-border); border-radius:var(--radius-md); padding:0 16px 0 40px; font-size:.85rem; font-family:'Manrope',sans-serif; outline:none; color:var(--clr-ink); background:var(--surface-card);"
        />
      </div>
      <select id="ordenarMembros" onchange="ordenarMembros(this.value)" style="height:46px; border:1.5px solid var(--clr-border); border-radius:var(--radius-md); padding:0 14px; font-size:.8rem; font-family:'Manrope',sans-serif; outline:none; color:var(--clr-ink); background:var(--surface-card); cursor:pointer;">
        <option value="padrao">Por ranking</option>
        <option value="alfa">Alfabético A-Z</option>
        <option value="id">Nº crescente</option>
      </select>
    </div>

    <!-- Tabela de ranking (restantes membros) -->
    <div class="ranking-table">
      <div class="rank-row head">
        <div>Nº de processo</div>
        <div>Membro</div>
        <div>Estado</div>
      </div>

      <div id="membrosGrid">
        <?php foreach ($membros as $m): ?>
          <a href="/membro/<?= $m['numero_processo'] ?>" class="rank-row member-row" data-nome="<?= strtolower($m['nome_passe']) ?>" data-id="<?= strtolower($m['numero_processo']) ?>">
            <div class="rank-num"><?= $m['numero_processo'] ?></div>
            <div class="rank-member">
              <div class="rank-avatar"></div>
              <span><?= $m['nome_passe'] ?></span>
            </div>
            <div class="rank-estado">
              <span class="clas-badge clas-badge-<?= $m['estado'] ?>">
                <span class="clas-badge-dot"></span><?= str_replace('_', ' ', $m['estado']) ?>
              </span>
            </div>
          </a>
        <?php endforeach; ?>
      </div>
    </div>

    <div id="membroEmpty" style="display:none; text-align:center; padding:2rem 1rem;">
      <p style="font-size:1rem; color:var(--clr-muted);">Nenhum membro encontrado.</p>
    </div>

    <div style="text-align:center; margin: 24px 0 32px;">
      <button id="verMaisBtn" onclick="verMais()" class="btn btn-primary" type="button" style="padding: 12px 32px; font-size: 14px;">
        Ver mais
      </button>
    </div>

    <!-- CTA -->
    <div class="league-cta" style="margin-top:32px;">
      <div>
        <h3>Quer ver o seu nome aqui?</h3>
        <p>Junte-se à competição semanal e ganhe destaque na comunidade.</p>
      </div>
      <a href="/inscricao" class="btn">Inscrever-se para competir</a>
    </div>

  </div>
</section>

<script>
function removerAcentos(str) {
  return str.normalize('NFD').replace(/[\u0300-\u036f]/g, '');
}

function pontuacao(texto, termo) {
  const t = removerAcentos(texto.toLowerCase());
  const q = removerAcentos(termo.toLowerCase()).trim();
  if (!q) return 0;
  if (t === q) return 100;
  if (t.startsWith(q)) return 80;
  if (t.includes(q)) return 60;
  const partes = q.split(/\s+/);
  let match = 0;
  partes.forEach(p => { if (t.includes(p)) match++; });
  if (match > 0) return (match / partes.length) * 50;
  let dist = 0;
  for (let i = 0; i < Math.min(q.length, t.length); i++) {
    if (t[i] === q[i]) dist++;
  }
  return (dist / Math.max(q.length, t.length)) * 30;
}

const LIMITE_INICIAL = 10;
let membrosVisiveis = LIMITE_INICIAL;

function aplicarPaginacao() {
  const linhas = Array.from(document.querySelectorAll('#membrosGrid .member-row'));
  const btn = document.getElementById('verMaisBtn');

  linhas.forEach((linha, i) => {
    linha.style.display = i < membrosVisiveis ? '' : 'none';
  });

  btn.style.display = membrosVisiveis < linhas.length ? 'inline-flex' : 'none';
  document.getElementById('membroEmpty').style.display = 'none';
}

function verMais() {
  membrosVisiveis += LIMITE_INICIAL;
  aplicarPaginacao();
}

function filtrarMembros(valor) {
  const termo = removerAcentos(valor.toLowerCase().trim());
  const btn = document.getElementById('verMaisBtn');

  // Campo vazio: volta ao modo paginado normal
  if (!termo) {
    membrosVisiveis = LIMITE_INICIAL;
    aplicarPaginacao();
    return;
  }

  // Com pesquisa ativa, mostra todos os resultados sem paginação
  btn.style.display = 'none';

  const linhas = document.querySelectorAll('.member-row');
  const grid = document.getElementById('membrosGrid');
  let apareceu = false;

  const comPontos = [];

  linhas.forEach(c => {
    const nome = c.getAttribute('data-nome');
    const id = c.getAttribute('data-id');
    const p = Math.max(pontuacao(nome, termo), pontuacao(id, termo));
    if (p > 0) {
      c.style.display = '';
      apareceu = true;
      comPontos.push({ linha: c, pontos: p });
    } else {
      c.style.display = 'none';
    }
  });

  if (comPontos.length > 0) {
    comPontos.sort((a, b) => b.pontos - a.pontos);
    comPontos.forEach(item => grid.appendChild(item.linha));
  }

  document.getElementById('membroEmpty').style.display = apareceu ? 'none' : 'block';
}

function ordenarMembros(criterio) {
  const grid = document.getElementById('membrosGrid');
  const linhas = Array.from(grid.querySelectorAll('.member-row'));

  linhas.sort((a, b) => {
    const nomeA = a.getAttribute('data-nome');
    const nomeB = b.getAttribute('data-nome');
    const idA = parseInt(a.getAttribute('data-id').replace('clas', ''));
    const idB = parseInt(b.getAttribute('data-id').replace('clas', ''));

    if (criterio === 'alfa') {
      // Ignora pontuação (ex: "P. Bosco" ordena como "P Bosco") e acentos
      const limpar = s => s.replace(/[.,'`´]/g, '').trim();
      return limpar(nomeA).localeCompare(limpar(nomeB), 'pt', { sensitivity: 'base' });
    }
    if (criterio === 'id') return idA - idB;
    return 0;
  });

  linhas.forEach(c => grid.appendChild(c));

  // Reaplica o estado atual (pesquisa ou paginação) depois de reordenar
  filtrarMembros(document.getElementById('searchMembro').value);
}

// Estado inicial da página: só mostra o primeiro lote
aplicarPaginacao();
</script>

<?php $content = ob_get_clean(); ?>
<?php require __DIR__ . '/../layouts/publica.php'; ?>