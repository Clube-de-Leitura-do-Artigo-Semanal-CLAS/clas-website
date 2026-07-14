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

      <!-- As linhas sao construidas pelo JS a partir do JSON abaixo.
           Assim o browser so renderiza as visiveis (10 de cada vez) em vez
           das ~490 de uma vez, mas a pesquisa e a ordenacao continuam a
           funcionar sobre a lista toda. -->
      <div id="membrosGrid"></div>
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
// Dados de todos os membros (leve: so os campos que a lista precisa)
const MEMBROS = <?= json_encode(array_map(fn($m) => [
  'p' => $m['numero_processo'],
  'n' => $m['nome_passe'],
  'e' => $m['estado'],
], $membros), JSON_UNESCAPED_UNICODE) ?>;
</script>
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

const LIMITE = 10;
let visiveis = LIMITE;
let listaAtual = MEMBROS.slice();   // lista corrente (apos pesquisa/ordenacao)

const grid  = document.getElementById('membrosGrid');
const btn   = document.getElementById('verMaisBtn');
const vazio = document.getElementById('membroEmpty');

function semAcentos(s) {
  return s.normalize('NFD').replace(/[\u0300-\u036f]/g, '');
}

// Constroi o HTML de uma linha
function linhaHTML(m) {
  const estadoLegivel = m.e.replace(/_/g, ' ');
  return `
    <a href="/membro/${m.p}" class="rank-row member-row">
      <div class="rank-num">${m.p}</div>
      <div class="rank-member">
        <div class="rank-avatar"></div>
        <span>${m.n}</span>
      </div>
      <div class="rank-estado">
        <span class="clas-badge clas-badge-${m.e}">
          <span class="clas-badge-dot"></span>${estadoLegivel}
        </span>
      </div>
    </a>`;
}

// Desenha apenas as linhas visiveis (nao as ~490 todas)
function render() {
  const aMostrar = listaAtual.slice(0, visiveis);
  grid.innerHTML = aMostrar.map(linhaHTML).join('');

  vazio.style.display = listaAtual.length === 0 ? 'block' : 'none';
  btn.style.display   = visiveis < listaAtual.length ? 'inline-flex' : 'none';
}

function verMais() {
  visiveis += LIMITE;
  render();
}

function filtrarMembros(valor) {
  const termo = semAcentos(valor.toLowerCase().trim());
  visiveis = LIMITE;

  if (!termo) {
    listaAtual = MEMBROS.slice();
  } else {
    listaAtual = MEMBROS.filter(m =>
      semAcentos(m.n.toLowerCase()).includes(termo) ||
      m.p.toLowerCase().includes(termo)
    );
  }
  render();
}

function ordenarMembros(criterio) {
  const limpar = s => s.replace(/[.,'`\u00b4]/g, '').trim();

  if (criterio === 'alfa') {
    listaAtual.sort((a, b) =>
      limpar(a.n).localeCompare(limpar(b.n), 'pt', { sensitivity: 'base' })
    );
  } else if (criterio === 'id') {
    listaAtual.sort((a, b) => a.p.localeCompare(b.p, 'pt', { numeric: true }));
  }
  visiveis = LIMITE;
  render();
}

// Arranque: ordenado por numero de processo
document.addEventListener('DOMContentLoaded', () => ordenarMembros('id'));
</script>

<?php $content = ob_get_clean(); ?>
<?php require __DIR__ . '/../layouts/publica.php'; ?>