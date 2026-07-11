<!DOCTYPE html>
<html lang="pt-AO">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Moderar Resenha — CLAS</title>
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
        <h1 class="page-title">Moderar Resenha</h1>
        <a href="/admin/resenhas" style="color:var(--c-primary);text-decoration:none;font-size:0.85rem;">← Voltar</a>
      </header>

      <div style="background:#fff;border-radius:12px;padding:2rem;max-width:700px;">
        <p style="margin-bottom:0.5rem;"><strong>Membro:</strong> <?= htmlspecialchars($resenha->membroId) ?></p>

        <form method="POST" action="/admin/resenhas/<?= $resenha->id ?>/moderar">
          <div style="margin-bottom:1rem;">
            <label style="display:block;font-weight:600;margin-bottom:4px;">Título do Livro</label>
            <input type="text" name="livro" value="<?= htmlspecialchars($resenha->livro) ?>" required
              style="width:100%;height:44px;border:1.5px solid var(--clr-border);border-radius:8px;padding:0 12px;font-family:inherit;font-size:0.9rem;">
          </div>

          <div style="margin-bottom:1rem;">
            <label style="display:block;font-weight:600;margin-bottom:4px;">Autor do Livro</label>
            <input type="text" name="autor" value="<?= htmlspecialchars($resenha->autor) ?>"
              style="width:100%;height:44px;border:1.5px solid var(--clr-border);border-radius:8px;padding:0 12px;font-family:inherit;font-size:0.9rem;">
          </div>

          <div style="margin-bottom:1.5rem;">
            <label style="display:block;font-weight:600;margin-bottom:6px;">Texto da resenha (podes editar)</label>
            <textarea name="texto" rows="8" required
              style="width:100%;border:1.5px solid var(--clr-border);border-radius:8px;padding:12px;font-family:inherit;font-size:0.9rem;resize:vertical;"><?= htmlspecialchars($resenha->texto) ?></textarea>
          </div>

          <div style="display:flex;gap:1rem;">
            <button type="submit" name="accao" value="aprovar"
              style="padding:10px 24px;border:none;border-radius:8px;background:#1B7A2B;color:#fff;font-weight:600;cursor:pointer;">
              <i class="ph ph-check"></i> Aprovar e Publicar
            </button>
            <button type="submit" name="accao" value="rejeitar"
              style="padding:10px 24px;border:none;border-radius:8px;background:#B33A3A;color:#fff;font-weight:600;cursor:pointer;">
              <i class="ph ph-x"></i> Rejeitar
            </button>
          </div>
        </form>
      </div>
    </main>
  </div>
</body>
</html>
