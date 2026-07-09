<!DOCTYPE html>
<html lang="pt-AO">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CLAS — Dashboard</title>
  <link rel="icon" href="/assets/img/logo.gif" type="image/gif" />
  <link rel="stylesheet" href="/assets/css/admin.css" />
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
  <div class="dash-bg"></div>
  
  <div class="dash-container">
    <aside class="sidebar">
      <div class="sidebar-header">
        <a href="index.html" style="text-decoration:none; display:flex; align-items:center; gap:10px;">
          <img src="assets/img/logo.gif" alt="CLAS" class="sidebar-logo" />
        </a>
      </div>
      
      <nav class="sidebar-nav">
        <a href="#" class="nav-item"><i class="ph ph-squares-four"></i> Dashboard</a>
        <a href="#" class="nav-item active"><i class="ph ph-users-three"></i> Membros</a>
        <a href="#" class="nav-item"><i class="ph ph-calendar-check"></i> Actividades</a>
        <a href="#" class="nav-item"><i class="ph ph-newspaper"></i> Notícias</a>
        <a href="#" class="nav-item"><i class="ph ph-question"></i> Kwizz</a>
        <a href="#" class="nav-item"><i class="ph ph-chart-line-up"></i> Estatística</a>
        <a href="#" class="nav-item"><i class="ph ph-star"></i> Livros do Mês</a>
        <a href="#" class="nav-item"><i class="ph ph-trophy"></i> Ranking</a>
        <a href="#" class="nav-item"><i class="ph ph-books"></i> Biblioteca</a>
      </nav>
      
      <div class="sidebar-footer">
        <a href="#" class="nav-item"><i class="ph ph-sign-out"></i> Terminar sessão</a>
      </div>
    </aside>

    <main class="main-content">
      <header class="topbar">
        <div class="search-bar">
          <i class="ph ph-magnifying-glass"></i>
          <input type="text" placeholder="Pesquisar..." />
        </div>
        
        <div class="topbar-right">
          <button class="icon-btn"><i class="ph ph-envelope-simple"></i></button>
          <button class="icon-btn"><i class="ph ph-bell"></i><span class="badge"></span></button>
          
          <div class="user-profile">
            <img src="assets/img/logo.gif" alt="User" class="avatar" />
            <div class="user-info">
              <span class="user-name">administrador</span>
              <span class="user-email">admin@clas.ao</span>
            </div>
            <i class="ph ph-caret-down"></i>
          </div>
        </div>
      </header>

      <div class="content-header">
        <h1 class="page-title">Membros</h1>
        
        <div class="content-actions">
          <div class="action-group">
            <span class="action-label">Mostrar</span>
            <select class="action-select">
              <option>10</option>
              <option>20</option>
              <option>50</option>
            </select>
          </div>
          
          <button class="btn btn-outline"><i class="ph ph-funnel"></i> Filtrar</button>
          <button class="btn btn-outline"><i class="ph ph-export"></i> Exportar</button>
          <button class="btn btn-primary"><i class="ph ph-plus"></i> Novo Membro</button>
        </div>
      </div>

      <!-- Table -->
      <div class="table-container">
        <table class="data-table">
          <thead>
            <tr>
              <th>ID CLAS <i class="ph ph-caret-up-down"></i></th>
              <th>Nome completo <i class="ph ph-caret-up-down"></i></th>
              <th>Email <i class="ph ph-caret-up-down"></i></th>
              <th>Telefone  <i class="ph ph-caret-up-down"></i></th>
              <th>Role</th>
              <th>Ação</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($membros)): ?>
              <tr>
                <td colspan="5" style="text-align: center; padding: 20px;">Nenhum membro encontrado.</td>
              </tr>
            <?php else: ?>
              <?php foreach ($membros as $membro): ?>
              <tr>
                <td style="font-weight: 600; color: var(--c-primary);"><?= htmlspecialchars($membro->numero_processo) ?></td>
                <td>
                  <div class="td-product">
                    <img src="https://ui-avatars.com/api/?name=<?= urlencode($membro->nome) ?>&background=random" alt="Avatar" style="border-radius: 50%;" />
                    <span><?= htmlspecialchars($membro->nome) ?></span>
                  </div>
                </td>
                <td><?= htmlspecialchars($membro->email) ?></td>
                <td><?= htmlspecialchars($membro->telefone ?? 'N/A') ?></td>
                <td><?= htmlspecialchars($membro->role ?? 'N/A') ?></td>
                <td>
                  <button class="btn-more" onclick="abrirModalRole(<?= $membro->id ?>, '<?= addslashes(htmlspecialchars($membro->nome, ENT_QUOTES)) ?>', '<?= addslashes(htmlspecialchars($membro->role ?? '', ENT_QUOTES)) ?>')">
                    <i class="ph ph-dots-three-outline-vertical"></i>
                  </button>
                </td>
              </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="pagination">
        <?php if ($paginaAtual > 1): ?>
          <a href="?page=<?= $paginaAtual - 1 ?>" class="page-btn" style="text-decoration:none;"><i class="ph ph-caret-left"></i> Anterior</a>
        <?php else: ?>
          <button class="page-btn" disabled style="opacity: 0.5;"><i class="ph ph-caret-left"></i> Anterior</button>
        <?php endif; ?>

        <div class="page-numbers">
          <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
            <?php if ($i === $paginaAtual): ?>
              <span class="page-num active"><?= str_pad($i, 2, '0', STR_PAD_LEFT) ?></span>
            <?php else: ?>
              <a href="?page=<?= $i ?>" class="page-num" style="text-decoration:none; color:inherit;"><?= str_pad($i, 2, '0', STR_PAD_LEFT) ?></a>
            <?php endif; ?>
          <?php endfor; ?>
        </div>

        <?php if ($paginaAtual < $totalPaginas): ?>
          <a href="?page=<?= $paginaAtual + 1 ?>" class="page-btn" style="text-decoration:none;">Próximo <i class="ph ph-caret-right"></i></a>
        <?php else: ?>
          <button class="page-btn" disabled style="opacity: 0.5;">Próximo <i class="ph ph-caret-right"></i></button>
        <?php endif; ?>
      </div>

    </main>
  </div>

  <script src="assets/js/admin.js"></script>
  <script>
    // Função para abrir o modal de alteração de role
    function abrirModalRole(id, nome, roleAtual) {
      // Obter os papéis possíveis. No mundo real, poderíamos vir via PHP JSON, mas estão definidos na classe Role.
      const rolesDisponiveis = {
        'admin': 'Administrador',
        'membro': 'Membro',
        'coordenadora': 'Coordenador de Leitura',
        'rececao': 'Recepcionista'
      };

      Swal.fire({
        title: 'Alterar Role',
        html: `Escolha o novo papel para o membro <b>${nome}</b>.`,
        input: 'select',
        inputOptions: rolesDisponiveis,
        inputValue: roleAtual,
        showCancelButton: true,
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: 'var(--c-primary, #0055ff)',
        inputValidator: (value) => {
          if (!value) return 'Tens de escolher uma role!';
          if (value === roleAtual) return 'Esta já é a role atual do membro.';
        }
      }).then((result) => {
        if (result.isConfirmed) {
          const novaRole = result.value;
          
          // Confirmação extra (A perguntar se tem a certeza, conforme pedido)
          Swal.fire({
            title: 'Tens a certeza?',
            text: `Queres mesmo alterar a role de ${nome} para ${rolesDisponiveis[novaRole]}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, alterar!',
            cancelButtonText: 'Não, cancelar'
          }).then((confirmacao) => {
            if (confirmacao.isConfirmed) {
              
              // Executar o pedido (AJAX/Fetch) para a nossa nova rota POST
              Swal.showLoading();
              
              fetch('/admin/membros/role', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'Accept': 'application/json'
                },
                body: JSON.stringify({
                  id: id,
                  role: novaRole
                })
              })
              .then(response => response.json())
              .then(data => {
                if (data.sucesso) {
                  Swal.fire(
                    'Atualizado!',
                    'A role foi alterada com sucesso.',
                    'success'
                  ).then(() => {
                    // Atualiza a página para ver a mudança refletida na lista
                    window.location.reload();
                  });
                } else {
                  Swal.fire('Erro', data.erro || 'Ocorreu um problema ao atualizar.', 'error');
                }
              })
              .catch(error => {
                console.error(error);
                Swal.fire('Erro', 'Ocorreu um erro na comunicação com o servidor.', 'error');
              });

            }
          });
        }
      });
    }
  </script>
</body>
</html>
