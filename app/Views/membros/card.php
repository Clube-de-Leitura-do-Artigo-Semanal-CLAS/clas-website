<?php $title = 'Meu Card — CLAS'; ?>

<?php
/* ─────────────────────────────────────────────
 *   DADOS EXEMPLARES (placeholder)
 *   Enquanto não há backend, o array abaixo
 *   simula o que virá da BD.
 *   Quando backend estiver pronto, $membro
 *   será passado pelo controller e este
 *   `?? [...]` só serve como fallback.
 * ───────────────────────────────────────────── */
$membro = $membro ?? [
    'iniciais' => 'AF',
    'nome' => 'Ana Ferreira',
    'processo' => 'CLAS-0042',
    'membro_desde' => 'jan/2025',
    'estado' => 'ativo',
    'objetivo' => 'Ler pelo menos 1 livro por mês e sair da zona de conforto de géneros.',
    'leituras' => 24,
    'debates' => 9,
    'eventos' => 5,
    'trofeus' => [
        ['icone' => 'bi-trophy-fill',   'nome' => 'Melhor Kwiz',      'cor' => '#F2B24C'],
        ['icone' => 'bi-book-fill',     'nome' => 'Presença debates', 'cor' => '#5B3FA8'],
        ['icone' => 'bi-star-fill',     'nome' => 'Leitor do Mês',    'cor' => '#1B6E96'],
    ],
    'historico' => [
        ['icone' => 'bi-book', 'nome' => 'O Mito de Sísifo', 'autor' => 'Albert Camus', 'meta' => 'Concluído · há 3 dias'],
        ['icone' => 'bi-book', 'nome' => 'Terra Sonâmbula', 'autor' => 'Mia Couto', 'meta' => 'Concluído · 12 jun'],
        ['icone' => 'bi-film', 'nome' => 'Sessão de cinema — CineMax', 'autor' => '', 'meta' => '30 mai'],
    ],
    'resenhas' => [
        [
            'id' => 1,
            'texto' => 'Um livro curto mas que muda a forma como se pensa sobre o absurdo da vida. Cada página é um convite à reflexão.',
            'livro' => 'O Mito de Sísifo',
            'data' => 'há 2 dias',
            'curtidas' => 12,
            'comentarios' => 3,
            'estado' => 'aprovada',
        ],
        [
            'id' => 2,
            'texto' => 'Uma obra que retrata a realidade angolana com uma sensibilidade única. Mia Couto nunca desilude.',
            'livro' => 'Terra Sonâmbula',
            'data' => 'há 5 dias',
            'curtidas' => 8,
            'comentarios' => 1,
            'estado' => 'aprovada',
        ],
        [
            'id' => 3,
            'texto' => 'Interessante análise sobre como pequenas mudanças nos hábitos podem transformar a vida.',
            'livro' => 'O Poder do Hábito',
            'data' => 'há 8 dias',
            'curtidas' => 5,
            'comentarios' => 0,
            'estado' => 'pendente',
        ],
    ],
];
?>
<?php ob_start(); ?>

<section style="padding: 2rem 1rem; min-height: 100vh; background: var(--clr-paper);">
  <div class="container" style="max-width: 640px;">

    <!-- ════════════════════════════════════
         PERFIL
         ════════════════════════════════════ -->
    <div class="clas-card">
      <div style="display: flex; justify-content: space-between; align-items: flex-start;">
        <div style="display: flex; gap: 14px; align-items: center;">
          <div class="clas-card-avatar"><?= $membro['iniciais'] ?></div>
          <div>
            <div class="clas-card-name"><?= $membro['nome'] ?></div>
            <div class="clas-card-meta">Nº <b><?= $membro['processo'] ?></b> · desde <?= $membro['membro_desde'] ?></div>
            <div class="clas-badge clas-badge-<?= $membro['estado'] ?>" style="margin-top: 6px;">
              <span class="clas-badge-dot"></span><?= ucfirst($membro['estado']) ?>
            </div>
          </div>
        </div>
        <div class="clas-card-qr"></div>
      </div>

      <div class="clas-card-objetivo" style="margin-top: 12px;">
        <b style="font-style: normal; color: var(--clr-text);">Objetivo:</b>
        <span>"<?= $membro['objetivo'] ?>"</span>
      </div>

      <div class="clas-section-label" style="margin-top: 1.25rem;">Atividade</div>
      <div class="clas-stat-grid">
        <div class="clas-stat-box">
          <div class="clas-stat-num"><?= $membro['leituras'] ?></div>
          <div class="clas-stat-label">Leituras</div>
        </div>
        <div class="clas-stat-box">
          <div class="clas-stat-num"><?= $membro['debates'] ?></div>
          <div class="clas-stat-label">Debates</div>
        </div>
        <div class="clas-stat-box">
          <div class="clas-stat-num"><?= $membro['eventos'] ?></div>
          <div class="clas-stat-label">Eventos</div>
        </div>
      </div>
    </div>

    <!-- ════════════════════════════════════
         TROFEUS — ícones coloridos com nome
         ════════════════════════════════════ -->
    <div style="margin-top: 1.5rem;">
      <div class="clas-section-label">Trofeus</div>
      <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
        <?php foreach ($membro['trofeus'] as $t): ?>
          <div style="display: flex; flex-direction: column; align-items: center; gap: 6px; padding: 12px 16px; background: var(--clr-white); border-radius: var(--radius-md); box-shadow: var(--shadow-card); min-width: 90px;">
            <div style="width: 40px; height: 40px; border-radius: 50%; background: <?= $t['cor'] ?>20; display: flex; align-items: center; justify-content: center;">
              <i class="<?= $t['icone'] ?>" style="font-size: 1.2rem; color: <?= $t['cor'] ?>;"></i>
            </div>
            <span style="font-size: 0.65rem; font-weight: 700; color: var(--clr-text); text-align: center; font-family: 'Manrope', sans-serif;"><?= $t['nome'] ?></span>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- ════════════════════════════════════
         HISTORICO — lista simples
         ════════════════════════════════════ -->
    <div style="margin-top: 1.5rem;">
      <div class="clas-section-label">Historico</div>
      <div style="background: var(--clr-white); border-radius: var(--radius-md); box-shadow: var(--shadow-card); padding: 0.5rem 1rem;">
        <?php foreach ($membro['historico'] as $h): ?>
          <div style="display: flex; align-items: center; gap: 12px; padding: 10px 0; border-bottom: 1px solid var(--clr-sunken);">
            <div style="width: 32px; height: 32px; border-radius: 50%; background: var(--clr-accent-subtle); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
              <i class="<?= $h['icone'] ?>" style="font-size: 0.85rem; color: var(--clr-accent);"></i>
            </div>
            <div>
              <div style="font-size: 0.8rem; font-weight: 600; color: var(--clr-text);">
                <?= $h['nome'] ?>
                <?= $h['autor'] ? "<span style=\"font-weight: 400; color: var(--clr-muted);\">— {$h['autor']}</span>" : '' ?>
              </div>
              <div style="font-size: 0.65rem; color: var(--clr-muted);"><?= $h['meta'] ?></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- ════════════════════════════════════
         RESENHAS PUBLICADAS — feed (só aprovadas)
         ════════════════════════════════════ -->
    <div style="margin-top: 1.5rem;">
      <div class="clas-section-label">Resenhas</div>

      <?php foreach (array_filter($membro['resenhas'], fn($r) => $r['estado'] === 'aprovada') as $r): ?>
        <div style="background: var(--clr-white); border-radius: var(--radius-md); box-shadow: var(--shadow-card); margin-bottom: 1rem; overflow: hidden;">

          <!-- Header -->
          <div style="display: flex; align-items: center; gap: 10px; padding: 14px 16px 0;">
            <div class="clas-card-avatar" style="width: 40px; height: 40px; font-size: 0.8rem;"><?= $membro['iniciais'] ?></div>
            <div style="flex: 1;">
              <div style="font-size: 0.85rem; font-weight: 700; color: var(--clr-dark);"><?= $membro['nome'] ?></div>
              <div style="font-size: 0.65rem; color: var(--clr-muted);">
                Resenha de "<?= $r['livro'] ?>" · <?= $r['data'] ?>
              </div>
            </div>
          </div>

          <!-- Body -->
          <div style="padding: 12px 16px; font-size: 0.85rem; line-height: 1.6; color: var(--clr-text); font-family: 'Playfair Display', serif; font-style: italic;">
            "<?= $r['texto'] ?>"
          </div>

          <!-- Actions -->
          <div style="padding: 8px 16px 12px; border-top: 1px solid var(--clr-sunken); margin: 0 16px;">
            <button style="background: none; border: none; padding: 4px 0; font-size: 0.75rem; color: var(--clr-muted); cursor: pointer; display: flex; align-items: center; gap: 4px; font-family: 'Manrope', sans-serif;">
              <i class="bi bi-hand-thumbs-up"></i> <?= $r['curtidas'] ?> Curtir
            </button>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php require __DIR__ . '/../layouts/publica.php'; ?>
