<!DOCTYPE html>
<html lang="pt-AO">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Moderar Resenhas — CLAS</title>
  <link rel="icon" href="/assets/img/logo.gif" type="image/gif">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>
  <div class="dash-bg"></div>
  <div class="dash-container">
    <aside class="sidebar">
      <div class="sidebar-header">
        <a href="/admin/membros" style="text-decoration:none; display:flex; align-items:center; gap:10px;">
          <img src="/assets/img/logo.gif" alt="CLAS" class="sidebar-logo">
        </a>
      </div>
      <nav class="sidebar-nav">
        <a href="/admin/membros" class="nav-item"><i class="ph ph-users-three"></i> Membros</a>
        <a href="/admin/presencas" class="nav-item"><i class="ph ph-calendar-check"></i> Presenças</a>
        <a href="/admin/resenhas" class="nav-item active"><i class="ph ph-newspaper"></i> Resenhas</a>
        <a href="/admin/estatisticas" class="nav-item"><i class="ph ph-chart-line-up"></i> Estatística</a>
      </nav>
    </aside>

    <main class="main-content">
      <header class="topbar">
        <h1 class="page-title">Moderar Resenhas</h1>
      </header>

      <div class="table-container">
        <table class="data-table">
          <thead>
            <tr>
              <th>Membro</th>
              <th>Nº Processo</th>
              <th>Livro</th>
              <th>Texto</th>
              <th>Data</th>
              <th>Ação</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($resenhas)): ?>
              <tr><td colspan="6" style="text-align:center;padding:20px;">Nenhuma resenha pendente.</td></tr>
            <?php else: ?>
              <?php foreach ($resenhas as $r): ?>
              <tr>
                <td><?= htmlspecialchars($r['membro_nome']) ?></td>
                <td><?= htmlspecialchars($r['numero_processo']) ?></td>
                <td><?= htmlspecialchars($r['livro']) ?></td>
                <td style="max-width:300px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"><?= htmlspecialchars(mb_substr($r['texto'], 0, 100)) ?>...</td>
                <td><?= date('d/m/Y', strtotime($r['criada_em'])) ?></td>
                <td>
                  <a href="/admin/resenhas/<?= $r['id'] ?>/moderar" class="btn btn-primary" style="padding:6px 14px;border-radius:6px;background:var(--c-primary);color:#fff;text-decoration:none;font-size:0.8rem;">Moderar</a>
                </td>
              </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</body>
</html>
