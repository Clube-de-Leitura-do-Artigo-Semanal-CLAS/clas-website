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
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    <aside class="sidebar" id="sidebar">
      <div class="sidebar-header">
        <a href="index.html" style="text-decoration:none; display:flex; align-items:center; gap:10px;">
          <img src="/assets/img/logo_clas.png" alt="CLAS" class="sidebar-logo" />
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
      
    </aside>

    <main class="main-content">
      <header class="topbar">
        <div class="topbar-left">
          <button class="icon-btn mobile-menu-btn" id="mobileMenuBtn"><i class="ph ph-list"></i></button>
          <h1 class="page-title">Membros</h1>
        </div>
        
        <div class="topbar-right">
          <button class="icon-btn"><i class="ph ph-envelope-simple"></i></button>
          <button class="icon-btn"><i class="ph ph-bell"></i><span class="badge"></span></button>
          
          <div class="user-profile" id="userProfileBtn">
            <img src="/assets/img/logo.gif" alt="User" class="avatar" />
            <div class="user-info">
              <span class="user-name" style="text-transform: capitalize;"><?= htmlspecialchars($_SESSION['role'] ?? 'Desconhecido') ?></span>
              <span class="user-email"><?= htmlspecialchars($_SESSION['nome_passe'] ?? '- - -') ?></span>
            </div>
            <i class="ph ph-caret-down"></i>
            <div class="dropdown-menu" id="userDropdown">
              <a href="/logout" class="dropdown-item"><i class="ph ph-sign-out"></i> Terminar sessão</a>
            </div>
          </div>
        </div>
      </header>

      <div class="content-header">
        
        <div class="content-actions">
          
          <!-- Search Bar -->
          <div class="search-bar">
            <i class="ph ph-magnifying-glass"></i>
            <input type="text" id="pesquisaMembros" placeholder="Pesquisar por nome, email ou ID..." value="<?= htmlspecialchars($termoPesquisa ?? '') ?>" autocomplete="off" />
          </div>

          <!-- Mostrar X por página -->
          <div class="action-group">
            <span class="action-label">Mostrar</span>
            <select class="action-select" id="filtroLimit">
              <option value="10" <?= $porPagina == 10 ? 'selected' : '' ?>>10</option>
              <option value="20" <?= $porPagina == 20 ? 'selected' : '' ?>>20</option>
              <option value="50" <?= $porPagina == 50 ? 'selected' : '' ?>>50</option>
            </select>
          </div>
          
          <!-- Filtro: Role -->
          <div class="action-group">
            <span class="action-label">Role</span>
            <select class="action-select" id="filtroRole">
              <option value="">Todos</option>
              <option value="membro"       <?= ($filtroRole ?? '') === 'membro'       ? 'selected' : '' ?>>Membro</option>
              <option value="coordenadora" <?= ($filtroRole ?? '') === 'coordenadora' ? 'selected' : '' ?>>Coordenadora</option>
              <option value="rececao"      <?= ($filtroRole ?? '') === 'rececao'      ? 'selected' : '' ?>>Recepcionista</option>
              <option value="admin"        <?= ($filtroRole ?? '') === 'admin'        ? 'selected' : '' ?>>Administrador</option>
            </select>
          </div>

          <!-- Filtro: Estado -->
          <div class="action-group">
            <span class="action-label">Estado</span>
            <select class="action-select" id="filtroEstado">
              <option value="">Todos</option>
              <option value="ativo"       <?= ($filtroEstado ?? '') === 'ativo'       ? 'selected' : '' ?>>Ativo</option>
              <option value="em_risco"    <?= ($filtroEstado ?? '') === 'em_risco'    ? 'selected' : '' ?>>Em Risco</option>
              <option value="inativo"     <?= ($filtroEstado ?? '') === 'inativo'     ? 'selected' : '' ?>>Inativo</option>
              <option value="adormecido"  <?= ($filtroEstado ?? '') === 'adormecido'  ? 'selected' : '' ?>>Adormecido</option>
            </select>
          </div>

          <button class="btn btn-primary"><i class="ph ph-plus"></i> Novo Membro</button>
        </div>
      </div>
      <div class="table-container">
        <table class="data-table">
          <thead>
            <tr>
              <th><a href="#" class="sort-link" data-col="numero_processo" style="text-decoration:none;color:inherit;">ID CLAS <i class="ph ph-caret-up-down" style="opacity:.4"></i></a></th>
              <th><a href="#" class="sort-link" data-col="nome" style="text-decoration:none;color:inherit;">Nome completo <i class="ph ph-caret-up-down" style="opacity:.4"></i></a></th>
              <th>Telefone</th>
              <th>Estado</th>
              <th>Role</th>
              <th>Ação</th>
            </tr>
          </thead>
          <tbody id="tabelaMembrosBody">

          </tbody>
        </table>
      </div>

      <div class="pagination" id="paginacaoContainer">
      </div>
      </div>

    </main>
  </div>

  <script src="assets/js/admin.js"></script>
  <script>

  (function () {
    const estado = {
      search : '',
      limit  : 10,
      role   : '',
      estado : '',
      sort   : 'id',
      dir    : 'desc',
      page   : 1,
    };

    const tbody      = document.getElementById('tabelaMembrosBody');
    const paginacao  = document.getElementById('paginacaoContainer');
    const searchInput = document.getElementById('pesquisaMembros');

    // --- Mapas de etiquetas ---
    const rolesLabel   = { membro:'Membro', coordenadora:'Coordenadora', rececao:'Recepcionista', admin:'Administrador' };
    const estadoLabel  = { ativo:'Ativo', em_risco:'Em Risco', inativo:'Inativo', adormecido:'Adormecido' };

    // --------------------------------------------------------
    // Chamada principal ao endpoint JSON
    // --------------------------------------------------------
    async function carregarMembros() {
      const params = new URLSearchParams();
      if (estado.search) params.set('search', estado.search);
      if (estado.role)   params.set('role',   estado.role);
      if (estado.estado) params.set('estado', estado.estado);
      if (estado.sort !== 'id')   params.set('sort', estado.sort);
      if (estado.dir  !== 'desc') params.set('dir',  estado.dir);
      if (estado.limit !== 10)    params.set('limit', estado.limit);
      if (estado.page  !== 1)     params.set('page',  estado.page);

      // Atualizar URL sem recarregar
      const urlAtual = '/admin/membros' + (params.toString() ? '?' + params.toString() : '');
      history.pushState(null, '', urlAtual);

      // Indicador de loading na tabela
      tbody.innerHTML = `<tr><td colspan="7" style="text-align:center;padding:30px;color:#888;"><i class="ph ph-circle-notch" style="animation:spin 1s linear infinite;margin-right:8px;"></i>A carregar...</td></tr>`;

      try {
        const resp = await fetch('/admin/membros/dados?' + params.toString());
        const data = await resp.json();

        if (!data.sucesso) {
          tbody.innerHTML = `<tr><td colspan="7" style="text-align:center;color:red;">Erro: ${data.erro}</td></tr>`;
          return;
        }

        renderTabela(data.membros);
        renderPaginacao(data.paginaAtual, data.totalPaginas);
        atualizarIconesOrdenacao();
      } catch (e) {
        tbody.innerHTML = `<tr><td colspan="7" style="text-align:center;color:red;">Erro de comunicação com o servidor.</td></tr>`;
      }
    }


    function renderTabela(membros) {
      if (!membros || membros.length === 0) {
        tbody.innerHTML = '<tr><td colspan="7" style="text-align:center;padding:30px;color:#888;">Nenhum membro encontrado.</td></tr>';
        return;
      }
      tbody.innerHTML = membros.map(m => {
        const avatarUrl = `https://ui-avatars.com/api/?name=${encodeURIComponent(m.nome)}&background=random`;
        const telef  = m.telefone || 'N/A';
        const estadoVal = m.estado || '';
        const roleVal   = m.role   || '';
        return `
          <tr>
            <td style="font-weight:600;color:var(--c-primary)">${escHtml(m.numero_processo)}</td>
            <td>
              <div class="td-product">
                <img src="${avatarUrl}" alt="Avatar" style="border-radius:50%;" />
                <span>${escHtml(m.nome)}</span>
              </div>
            </td>
            <td>${escHtml(telef)}</td>
            <td><span class="estado-badge estado-${estadoVal}">${estadoLabel[estadoVal] || ucfirst(estadoVal)}</span></td>
            <td>${rolesLabel[roleVal] || escHtml(roleVal)}</td>
            <td>
              <button class="btn-more" onclick="abrirModalRole(${m.id}, '${escJs(m.nome)}', '${escJs(roleVal)}')">
                <i class="ph ph-dots-three-outline-vertical"></i>
              </button>
            </td>
          </tr>`;
      }).join('');
    }

    // --------------------------------------------------------
    // Renderizar paginação
    // --------------------------------------------------------
    function renderPaginacao(atual, total) {
      if (total <= 1) { paginacao.innerHTML = ''; return; }

      const janela = 2;
      const inicio = Math.max(1, atual - janela);
      const fim    = Math.min(total, atual + janela);
      let html = '';

      // Botão Anterior
      html += atual > 1
        ? `<a href="#" class="page-btn" data-page="${atual - 1}"><i class="ph ph-caret-left"></i> Anterior</a>`
        : `<button class="page-btn" disabled style="opacity:.5"><i class="ph ph-caret-left"></i> Anterior</button>`;

      html += '<div class="page-numbers">';
      if (inicio > 1) {
        html += `<a href="#" class="page-num" data-page="1">01</a>`;
        if (inicio > 2) html += '<span style="color:#888;padding:0 5px">...</span>';
      }
      for (let i = inicio; i <= fim; i++) {
        const label = String(i).padStart(2, '0');
        html += i === atual
          ? `<span class="page-num active">${label}</span>`
          : `<a href="#" class="page-num" data-page="${i}">${label}</a>`;
      }
      if (fim < total) {
        if (fim < total - 1) html += '<span style="color:#888;padding:0 5px">...</span>';
        html += `<a href="#" class="page-num" data-page="${total}">${String(total).padStart(2,'0')}</a>`;
      }
      html += '</div>';

      // Botão Próximo
      html += atual < total
        ? `<a href="#" class="page-btn" data-page="${atual + 1}">Próximo <i class="ph ph-caret-right"></i></a>`
        : `<button class="page-btn" disabled style="opacity:.5">Próximo <i class="ph ph-caret-right"></i></button>`;

      paginacao.innerHTML = html;

      // Eventos nos links de página
      paginacao.querySelectorAll('[data-page]').forEach(a => {
        a.addEventListener('click', e => {
          e.preventDefault();
          estado.page = parseInt(a.dataset.page);
          carregarMembros();
        });
      });
    }

    // --------------------------------------------------------
    // Atualizar ícones nos cabeçalhos de ordenação
    // --------------------------------------------------------
    function atualizarIconesOrdenacao() {
      document.querySelectorAll('.sort-link').forEach(link => {
        const col  = link.dataset.col;
        const icon = link.querySelector('i');
        if (col === estado.sort) {
          icon.className = estado.dir === 'asc' ? 'ph ph-caret-up' : 'ph ph-caret-down';
          icon.style.color   = 'var(--c-primary, #0055ff)';
          icon.style.opacity = '1';
        } else {
          icon.className    = 'ph ph-caret-up-down';
          icon.style.color  = '';
          icon.style.opacity = '.4';
        }
      });
    }

    // --------------------------------------------------------
    // Utilitários
    // --------------------------------------------------------
    function escHtml(str) {
      if (str == null) return '';
      return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }
    function escJs(str) {
      if (str == null) return '';
      return String(str).replace(/'/g,"\\'").replace(/"/g,'\\"');
    }
    function ucfirst(str) {
      if (!str) return '';
      return str.charAt(0).toUpperCase() + str.slice(1);
    }

    // --------------------------------------------------------
    // Ligar eventos a todos os controlos
    // --------------------------------------------------------
    document.addEventListener('DOMContentLoaded', () => {

      // Pesquisa com debounce
      let debounceTimer;
      searchInput?.addEventListener('input', function() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
          estado.search = this.value.trim();
          estado.page   = 1;
          carregarMembros();
        }, 400);
      });

      // Dropdowns de filtro
      document.getElementById('filtroLimit')?.addEventListener('change', function() {
        estado.limit = parseInt(this.value);
        estado.page  = 1;
        carregarMembros();
      });
      document.getElementById('filtroRole')?.addEventListener('change', function() {
        estado.role = this.value;
        estado.page = 1;
        carregarMembros();
      });
      document.getElementById('filtroEstado')?.addEventListener('change', function() {
        estado.estado = this.value;
        estado.page   = 1;
        carregarMembros();
      });

      // Cabeçalhos de ordenação
      document.querySelectorAll('.sort-link').forEach(link => {
        link.addEventListener('click', e => {
          e.preventDefault();
          const col = link.dataset.col;
          estado.dir  = (estado.sort === col && estado.dir === 'asc') ? 'desc' : 'asc';
          estado.sort = col;
          estado.page = 1;
          carregarMembros();
        });
      });

      // Carregar imediatamente ao abrir a página
      carregarMembros();
    });
  })();

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

    // ============================================================
    // LÓGICA DA UI (Mobile Sidebar & User Dropdown)
    // ============================================================
    document.addEventListener("DOMContentLoaded", function() {
      const userProfileBtn = document.getElementById("userProfileBtn");
      const userDropdown = document.getElementById("userDropdown");
      const mobileMenuBtn = document.getElementById("mobileMenuBtn");
      const sidebar = document.getElementById("sidebar");
      const sidebarOverlay = document.getElementById("sidebarOverlay");

      // Toggle user dropdown
      if (userProfileBtn && userDropdown) {
        userProfileBtn.addEventListener("click", function(e) {
          e.stopPropagation();
          userDropdown.classList.toggle("show");
        });
      }

      // Close dropdown when clicking outside
      document.addEventListener("click", function(e) {
        if (userDropdown && userDropdown.classList.contains("show")) {
          if (!userProfileBtn.contains(e.target)) {
            userDropdown.classList.remove("show");
          }
        }
      });

      // Mobile Menu Toggle
      if (mobileMenuBtn && sidebar && sidebarOverlay) {
        mobileMenuBtn.addEventListener("click", function() {
          sidebar.classList.add("open");
          sidebarOverlay.classList.add("show");
        });

        // Close when clicking on overlay
        sidebarOverlay.addEventListener("click", function() {
          sidebar.classList.remove("open");
          sidebarOverlay.classList.remove("show");
        });
      }
    });

  </script>
</body>
</html>
