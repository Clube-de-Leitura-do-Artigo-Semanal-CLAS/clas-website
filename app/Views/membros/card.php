<?php $title = ($membro['nome'] ?? 'Perfil') . ' — CLAS'; ?>

<?php ob_start(); ?>

<section style="padding: 2rem 1rem; min-height: 100vh; background: var(--clr-paper);">
  <div class="container" style="max-width: 640px;">

    <!-- ════════════════════════════════════
         VOLTAR
         ════════════════════════════════════ -->
    <a href="/membros" style="display: inline-flex; align-items: center; gap: 6px; color: var(--clr-accent); font-size: 0.8rem; font-weight: 600; text-decoration: none; margin-bottom: 1rem; font-family: 'Manrope', sans-serif;">
      <i class="bi bi-arrow-left"></i> Todos os membros
    </a>

    <!-- ════════════════════════════════════
         PERFIL
         ════════════════════════════════════ -->
    <div class="clas-card">
      <div style="display: flex; justify-content: space-between; align-items: flex-start;">
        <div style="display: flex; gap: 14px; align-items: center;">
          <img src="https://ui-avatars.com/api/?name=<?= urlencode($membro['nome']) ?>&background=1B4F8C&color=fff&size=80" alt="<?= $membro['nome'] ?>" style="width: 56px; height: 56px; border-radius: 50%; object-fit: cover; border: 2px solid var(--clr-border); flex-shrink: 0;">
          <div>
            <div class="clas-card-name"><?= $membro['nome'] ?></div>
            <div class="clas-card-meta">Nº <b><?= $membro['processo'] ?></b> &middot; desde <?= $membro['membro_desde'] ?></div>
            <div class="clas-badge clas-badge-<?= $membro['estado'] ?>" style="margin-top: 6px;">
              <span class="clas-badge-dot"></span><?= ucfirst($membro['estado']) ?>
            </div>
          </div>
        </div>
        <div class="clas-card-qr"></div>
      </div>

      <div class="clas-card-objetivo" style="margin-top: 12px;">
        <b style="font-style: normal; color: var(--clr-text);">Objetivo de entrada:</b>
        <span>"<?= $membro['objetivo'] ?>"</span>
      </div>

      <div class="clas-section-label" style="margin-top: 1.25rem;">Atividade</div>
      <table style="width: 100%; border-collapse: collapse; margin-top: 8px;">
        <tr>
          <td style="text-align: center; padding: 10px 0;"><span style="font-size: 1.5rem; font-weight: 800; color: var(--clr-accent);"><?= $membro['leituras'] ?></span><br><span style="font-size: 0.65rem; color: var(--clr-muted); text-transform: uppercase; letter-spacing: 0.05em; font-weight: 700;">Leituras</span></td>
          <td style="text-align: center; padding: 10px 0; border-left: 1px solid var(--clr-sunken);"><span style="font-size: 1.5rem; font-weight: 800; color: var(--clr-accent);"><?= $membro['debates'] ?></span><br><span style="font-size: 0.65rem; color: var(--clr-muted); text-transform: uppercase; letter-spacing: 0.05em; font-weight: 700;">Debates</span></td>
          <td style="text-align: center; padding: 10px 0; border-left: 1px solid var(--clr-sunken);"><span style="font-size: 1.5rem; font-weight: 800; color: var(--clr-accent);"><?= $membro['eventos'] ?></span><br><span style="font-size: 0.65rem; color: var(--clr-muted); text-transform: uppercase; letter-spacing: 0.05em; font-weight: 700;">Eventos</span></td>
        </tr>
      </table>
    </div>

    <!-- ════════════════════════════════════
         TROFEUS
         ════════════════════════════════════ -->
    <?php if (!empty($membro['trofeus'])): ?>
    <div style="margin-top: 1.5rem;">
      <div class="clas-section-label">Trofeus & Conquistas</div>
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
    <?php endif; ?>

    <!-- ════════════════════════════════════
         HISTORICO
         ════════════════════════════════════ -->
    <?php if (!empty($membro['historico'])): ?>
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
    <?php endif; ?>

    <!-- ════════════════════════════════════
         RESENHAS PUBLICADAS (só aprovadas)
         ════════════════════════════════════ -->
    <?php
    $aprovadas = array_filter($membro['resenhas'], fn($r) => $r['estado'] === 'aprovada');
    ?>
    <?php if (!empty($aprovadas)): ?>
    <div style="margin-top: 1.5rem;">
      <div class="clas-section-label">Resenhas</div>

      <?php foreach ($aprovadas as $r): ?>
        <div style="background: var(--clr-white); border-radius: var(--radius-md); box-shadow: var(--shadow-card); margin-bottom: 1rem; overflow: hidden;">

          <div style="display: flex; align-items: center; gap: 10px; padding: 14px 16px 0;">
            <img src="https://ui-avatars.com/api/?name=<?= urlencode($membro['nome']) ?>&background=1B4F8C&color=fff&size=60" alt="<?= $membro['nome'] ?>" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; flex-shrink: 0;">
            <div style="flex: 1;">
              <div style="font-size: 0.85rem; font-weight: 700; color: var(--clr-dark);"><?= $membro['nome'] ?></div>
              <div style="font-size: 0.65rem; color: var(--clr-muted);">
                Resenha de "<?= $r['livro'] ?>" &middot; <?= $r['data'] ?>
              </div>
            </div>
          </div>

          <div style="padding: 12px 16px; font-size: 0.85rem; line-height: 1.6; color: var(--clr-text); font-family: 'Playfair Display', serif; font-style: italic;">
            "<?= $r['texto'] ?>"
          </div>

          <div style="padding: 8px 16px 12px; border-top: 1px solid var(--clr-sunken); margin: 0 16px;">
            <button style="background: none; border: none; padding: 4px 0; font-size: 0.75rem; color: var(--clr-muted); cursor: pointer; display: flex; align-items: center; gap: 4px; font-family: 'Manrope', sans-serif;">
              <i class="bi bi-hand-thumbs-up"></i> <?= $r['curtidas'] ?> Curtir
            </button>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

  </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php require __DIR__ . '/../layouts/publica.php'; ?>
