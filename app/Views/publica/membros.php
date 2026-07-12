<?php $title = 'Membros — CLAS'; ?>
<?php ob_start(); ?>

<section style="padding: 3rem 1rem; min-height: 100vh; background: var(--clr-paper);">
  <div class="container" style="max-width: 900px;">

    <!-- Header + pesquisa -->
    <div style="display: flex; flex-direction: column; gap: 1.25rem; margin-bottom: 2.5rem;">
      <h1 style="font-family: 'Playfair Display', serif; font-weight: 700; font-size: 2rem; color: var(--clr-dark); margin: 0;">
        Membros do Clube
      </h1>
      <div style="display: flex; gap: 0.75rem; flex-wrap: wrap; align-items: center;">
        <div style="position: relative; flex: 1; min-width: 200px; max-width: 400px;">
          <i class="bi bi-search" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--clr-muted); font-size: 0.9rem;"></i>
          <input
            id="searchMembro"
            type="text"
            placeholder="Pesquisar por nome ou ID..."
            oninput="filtrarMembros(this.value)"
            style="width: 100%; height: 46px; border: 1.5px solid var(--clr-border); border-radius: var(--radius-md); padding: 0 16px 0 40px; font-size: 0.85rem; font-family: 'Manrope', sans-serif; outline: none; color: var(--clr-text); background: var(--clr-white); transition: border-color 0.2s;"
            onfocus="this.style.borderColor='var(--clr-accent)'"
            onblur="this.style.borderColor='var(--clr-border)'"
          />
        </div>
        <select id="ordenarMembros" onchange="ordenarMembros(this.value)" style="height: 46px; border: 1.5px solid var(--clr-border); border-radius: var(--radius-md); padding: 0 14px; font-size: 0.8rem; font-family: 'Manrope', sans-serif; outline: none; color: var(--clr-text); background: var(--clr-white); cursor: pointer;">
          <option value="id" selected>Nº crescente</option>
          <option value="alfa">Alfabético A-Z</option>
          <option value="padrao">Por ranking</option>
        </select>
        <script>document.addEventListener('DOMContentLoaded', () => ordenarMembros('id'));</script>
      </div>
    </div>

    <!-- Top 3 -->
    <div style="margin-bottom: 2.5rem;">
      <div class="clas-section-label">Melhores leitores</div>
      <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;">
        <?php
        $coresTop = [
          ['fundo' => '#FFE8A3', 'borda' => '#F2B24C', 'icone' => '#B87A00'],
          ['fundo' => '#E8E8E8', 'borda' => '#B0B0B0', 'icone' => '#707070'],
          ['fundo' => '#F0DCC8', 'borda' => '#CD7F32', 'icone' => '#8B5A2B'],
        ];
        foreach ($top3 as $i => $m):
          $c = $coresTop[$i];
        ?>
          <a href="/membro/<?= $m['numero_processo'] ?>" style="text-decoration: none; display: block;">
            <div style="background: <?= $c['fundo'] ?>; border-radius: var(--radius-md); border: 2px solid <?= $c['borda'] ?>; padding: 1.5rem 1.25rem; text-align: center; transition: transform 0.2s;">
              <div style="width: 52px; height: 52px; border-radius: 50%; background: <?= $c['icone'] ?>20; color: <?= $c['icone'] ?>; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px;">
                <i class="bi bi-trophy-fill" style="font-size: 1.3rem;"></i>
              </div>
              <div style="font-size: 0.9rem; font-weight: 700; color: var(--clr-dark); font-family: 'Manrope', sans-serif;"><?= $m['nome_passe'] ?></div>
              <div style="font-size: 0.65rem; color: var(--clr-muted); margin-bottom: 10px;"><?= $m['numero_processo'] ?></div>
              <div style="display: flex; align-items: baseline; justify-content: center; gap: 4px;">
                <span style="font-size: 1.5rem; font-weight: 800; color: var(--clr-accent);"><?= $m['leituras'] ?></span>
                <span style="font-size: 0.6rem; color: var(--clr-muted); text-transform: uppercase; letter-spacing: 0.05em; font-weight: 700;">leituras</span>
              </div>
              <div style="font-size: 0.65rem; color: var(--clr-muted); margin-top: 8px; font-style: italic;">
                <?= $m['ultimo'] ?? '—' ?>
              </div>
            </div>
          </a>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Todos os membros -->
    <div class="clas-section-label">Todos os membros</div>
    <div id="membrosGrid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 0.75rem;">

      <?php foreach ($membros as $m): ?>
        <a href="/membro/<?= $m['numero_processo'] ?>" class="membro-card" data-nome="<?= strtolower($m['nome_passe']) ?>" data-id="<?= strtolower($m['numero_processo']) ?>" style="text-decoration: none; display: block;">
          <div style="background: var(--clr-white); border-radius: var(--radius-md); box-shadow: 0 2px 8px rgba(26,16,8,0.06); padding: 1rem 1.15rem; display: flex; align-items: center; gap: 14px; transition: box-shadow 0.2s, transform 0.2s;">
            <div style="width: 44px; height: 44px; border-radius: 50%; background: var(--clr-accent-subtle); color: var(--clr-accent); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
              <i class="bi bi-person-fill" style="font-size: 1.1rem;"></i>
            </div>
            <div style="flex: 1; min-width: 0;">
              <div style="font-size: 0.9rem; font-weight: 600; color: var(--clr-text); font-family: 'Manrope', sans-serif;"><?= $m['nome_passe'] ?></div>
              <div style="font-size: 0.7rem; color: var(--clr-muted); margin-top: 2px;"><?= $m['numero_processo'] ?></div>
            </div>
            <i class="bi bi-chevron-right" style="color: var(--clr-muted-light); font-size: 0.8rem;"></i>
          </div>
        </a>
      <?php endforeach; ?>

    </div>

    <div id="membroEmpty" style="display: none; text-align: center; padding: 3rem 1rem;">
      <p style="font-size: 1rem; color: var(--clr-muted); font-family: 'Manrope', sans-serif;">Nenhum membro encontrado.</p>
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

function filtrarMembros(valor) {
  const termo = removerAcentos(valor.toLowerCase().trim());
  const cards = document.querySelectorAll('.membro-card');
  const grid = document.getElementById('membrosGrid');
  let apareceu = false;

  if (termo === '') {
    cards.forEach(c => { c.style.display = 'block'; c.style.order = ''; });
    document.getElementById('membroEmpty').style.display = 'none';
    ordenarMembros(document.getElementById('ordenarMembros').value);
    return;
  }

  const comPontos = [];

  cards.forEach(c => {
    const nome = c.getAttribute('data-nome');
    const id = c.getAttribute('data-id');
    const p = Math.max(pontuacao(nome, termo), pontuacao(id, termo));
    if (p > 0) {
      c.style.display = 'block';
      c.style.order = Math.round(100 - p);
      apareceu = true;
      comPontos.push({ card: c, pontos: p });
    } else {
      c.style.display = 'none';
    }
  });

  if (comPontos.length > 0) {
    comPontos.sort((a, b) => b.pontos - a.pontos);
    comPontos.forEach(item => grid.appendChild(item.card));
  }

  document.getElementById('membroEmpty').style.display = apareceu ? 'none' : 'block';
}

function ordenarMembros(criterio) {
  const grid = document.getElementById('membrosGrid');
  const cards = Array.from(grid.querySelectorAll('.membro-card'));

  cards.sort((a, b) => {
    const nomeA = a.getAttribute('data-nome');
    const nomeB = b.getAttribute('data-nome');
    const idA = parseInt(a.getAttribute('data-id').replace('clas', ''));
    const idB = parseInt(b.getAttribute('data-id').replace('clas', ''));

    if (criterio === 'alfa') return nomeA.localeCompare(nomeB);
    if (criterio === 'id') return idA - idB;
    return 0;
  });

  cards.forEach(c => { c.style.order = ''; grid.appendChild(c); });
}
</script>

<?php $content = ob_get_clean(); ?>
<?php require __DIR__ . '/../layouts/publica.php'; ?>
