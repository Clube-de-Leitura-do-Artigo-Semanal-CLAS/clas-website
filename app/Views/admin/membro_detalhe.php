<?php
if (!isset($membro)) {
    header('Location: /admin/membros');
    exit;
}

$avatarUrl = "https://ui-avatars.com/api/?name=" . urlencode($membro->nome) . "&background=random&size=128";

$estadoLabels = ['ativo'=>'Ativo', 'em risco'=>'Em Risco', 'inativo'=>'Inativo', 'fantasma'=>'Fantasma'];
$estadoLabel = $estadoLabels[$membro->estado] ?? ucfirst($membro->estado);
$estadoCssClass = str_replace(' ', '-', $membro->estado);
?>
<!DOCTYPE html>
<html lang="pt-AO">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Perfil do Membro — CLAS</title>
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
        <a href="/" style="text-decoration:none; display:flex; align-items:center; gap:10px;">
          <img src="/assets/img/logo_clas.png" alt="CLAS" class="sidebar-logo" />
        </a>
      </div>
      
      <nav class="sidebar-nav">
        <a href="#" class="nav-item"><i class="ph ph-squares-four"></i> Dashboard</a>
        <a href="/admin/membros" class="nav-item active"><i class="ph ph-users-three"></i> Membros</a>
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
          <div style="display:flex; align-items:center; gap:8px;">
            <a href="/admin/membros" class="icon-btn" style="text-decoration:none;"><i class="ph ph-arrow-left"></i></a>
            <h1 class="page-title">Perfil</h1>
          </div>
        </div>
        
        <div class="topbar-right">
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

      <div class="detalhe-grid">
        <div class="d-card">
          <div class="profile-header">
            <div style="display: flex; flex-direction: column; align-items: center; gap: 12px;">
              <div class="profile-avatar-wrap">
                <img src="<?= $avatarUrl ?>" alt="Foto" class="profile-avatar" />
              </div>
              <span class="estado-badge estado-<?= $estadoCssClass ?>" id="badge-estado" onclick="abrirModalEstado()" style="cursor: pointer;" title="Alterar Estado"><?= $estadoLabel ?></span>
            </div>
            
            <div class="profile-info" id="view-perfil">
              <h2 class="profile-name">
                <span id="txt-nome"><?= htmlspecialchars($membro->nome) ?></span>
                <button class="edit-btn" onclick="toggleEdit('perfil')" title="Editar"><i class="ph ph-pencil-simple"></i></button>
              </h2>
              
              <div class="info-list">
                <div class="info-item">
                  <span class="label">Num de Processo:</span>
                  <span id="txt-numero_processo"><strong><?= htmlspecialchars($membro->numero_processo) ?></strong></span>
                </div>
                <div class="info-item">
                  <span class="label">Nome do Passe:</span>
                  <span id="txt-nome_passe"><?= htmlspecialchars($membro->nome_passe ?? 'N/A') ?></span>
                </div>
                 <div class="info-item">
                  <span class="label">E-mail:</span>
                  <span id="txt-email"><?= htmlspecialchars($membro->email) ?></span>
                </div>
                <div class="info-item">
                  <span class="label">Telefone:</span>
                  <span id="txt-telefone"><?= htmlspecialchars($membro->telefone ?? 'N/A') ?></span>
                </div>
                <div class="info-item">
                  <span class="label">Telefone Alt:</span>
                  <span id="txt-telefone_alternativo"><?= htmlspecialchars($membro->telefone_alternativo ?? 'N/A') ?></span>
                </div>
                <div class="info-item">
                  <span class="label">Role:</span>
                  <strong style="text-transform: uppercase;"><span><?= htmlspecialchars($membro->role ?? 'N/A') ?></span></strong>
                </div>
                <div class="info-item">
                  <span class="label">Idade:</span>
                  <strong style="text-transform: uppercase;"><span><?= htmlspecialchars($membro->idade ?? 'N/A') ?></span></strong>
                </div>          
              </div>
            </div>

            <!-- MODO DE EDIÇÃO DO PERFIL -->
            <div class="profile-info" id="edit-perfil" style="display:none;">
              <h2 class="profile-name">
                <input type="text" id="inp-nome" value="<?= htmlspecialchars($membro->nome) ?>" style="font-size:1.5rem; font-weight:700; width:100%; border:1px solid #d1d5db; border-radius:8px; padding:4px 8px;"/>
              </h2>
              
              <div class="info-list">
                <div class="info-item">
                  <span class="label">Num de Processo:</span>
                  <input type="text" id="inp-numero_processo" value="<?= htmlspecialchars($membro->numero_processo) ?>" style="width:100%; border:1px solid #d1d5db; border-radius:8px; padding:4px 8px;"/>
                </div>
                <div class="info-item">
                  <span class="label">Nome do Passe:</span>
                  <input type="text" id="inp-nome_passe" value="<?= htmlspecialchars($membro->nome_passe ?? '') ?>" style="width:100%; border:1px solid #d1d5db; border-radius:8px; padding:4px 8px;"/>
                </div>
                 <div class="info-item">
                  <span class="label">E-mail:</span>
                  <input type="email" id="inp-email" value="<?= htmlspecialchars($membro->email) ?>" style="width:100%; border:1px solid #d1d5db; border-radius:8px; padding:4px 8px;"/>
                </div>
                <div class="info-item">
                  <span class="label">Telefone:</span>
                  <input type="text" id="inp-telefone" value="<?= htmlspecialchars($membro->telefone ?? '') ?>" style="width:100%; border:1px solid #d1d5db; border-radius:8px; padding:4px 8px;"/>
                </div>
                <div class="info-item">
                  <span class="label">Telefone Alt:</span>
                  <input type="text" id="inp-telefone_alternativo" value="<?= htmlspecialchars($membro->telefone_alternativo ?? '') ?>" style="width:100%; border:1px solid #d1d5db; border-radius:8px; padding:4px 8px;"/>
                </div>
                <div class="info-item">
                  <span class="label">Idade (apenas visual):</span>
                  <input type="text" id="inp-idade" value="<?= htmlspecialchars($membro->idade ?? '') ?>" style="width:100%; border:1px solid #d1d5db; border-radius:8px; padding:4px 8px;"/>
                </div>          
              </div>
              <div style="margin-top:20px; display:flex; gap:12px;">
                <button onclick="salvarCartao('perfil')" class="btn-danger" style="background:#10b981; margin:0; width:auto; padding:8px 24px;">Guardar</button>
                <button onclick="toggleEdit('perfil')" class="btn-white" style="margin:0; width:auto; padding:8px 24px; border:1px solid #d1d5db;">Cancelar</button>
              </div>
            </div>
          </div>
          <div class="profile-bio" id="view-objetivos">
            <h3 class="bio-title">
              Objectivo de Entrada
              <button class="edit-btn" onclick="toggleEdit('objetivos')" title="Editar" style="float:right;"><i class="ph ph-pencil-simple"></i></button>
            </h3>
            <p class="bio-text" id="txt-objetivos">
              <?= nl2br(htmlspecialchars($membro->objetivos_entrada ?? 'Sem objetivos disponíveis.')) ?>
            </p>
          </div>

          <!-- MODO DE EDIÇÃO OBJETIVOS -->
          <div class="profile-bio" id="edit-objetivos" style="display:none; padding-top:20px;">
            <h3 class="bio-title" style="margin-bottom:12px;">Objectivo de Entrada</h3>
            <textarea id="inp-objetivos" style="width:100%; min-height:80px; border:1px solid #d1d5db; border-radius:8px; padding:12px; font-family:inherit; resize:vertical;"><?= htmlspecialchars($membro->objetivos_entrada ?? '') ?></textarea>
            <div style="margin-top:12px; display:flex; gap:12px;">
              <button onclick="salvarCartao('objetivos')" class="btn-danger" style="background:#10b981; margin:0; width:auto; padding:8px 24px;">Guardar</button>
              <button onclick="toggleEdit('objetivos')" class="btn-white" style="margin:0; width:auto; padding:8px 24px; border:1px solid #d1d5db;">Cancelar</button>
            </div>
          </div>
        </div>

        <div class="d-card-explication" id="view-inscricao" style="position:relative;">
          <button class="edit-btn" onclick="toggleEdit('inscricao')" title="Editar" style="position:absolute; top:24px; right:24px;"><i class="ph ph-pencil-simple"></i></button>
          
          <div class="explication-item">
            <h3 class="card-title">Como conheceu a CLAS?</h3>
            <i class="ph ph-quotes" style="font-size: 1.9rem; color: #2c17e4;"></i>
            <p class="tl-desc" id="txt-como_conheceu">
              <?= nl2br(htmlspecialchars($membro->como_conheceu_clas ?? 'N/A')) ?>
            </p>
          </div>
          <div class="explication-item">
            <h3 class="card-title">Motivo de Entrada no CLAS?</h3>
            <i class="ph ph-quotes" style="font-size: 1.9rem; color: #2c17e4;"></i>
            <p class="tl-desc" id="txt-motivo">
              <?= nl2br(htmlspecialchars($membro->motivo_entrada ?? 'N/A')) ?>
            </p>
          </div>
        </div>

        <!-- MODO DE EDIÇÃO INSCRIÇÃO -->
        <div class="d-card-explication" id="edit-inscricao" style="display:none; padding:24px; background:#fff; border-radius:24px; box-shadow:0 10px 40px rgba(0,0,0,0.04);">
          <div style="margin-bottom:20px;">
            <h3 class="card-title" style="margin-bottom:8px;">Como conheceu a CLAS?</h3>
            <input type="text" id="inp-como_conheceu" value="<?= htmlspecialchars($membro->como_conheceu_clas ?? '') ?>" style="width:100%; border:1px solid #d1d5db; border-radius:8px; padding:12px;" />
          </div>
          <div style="margin-bottom:20px;">
            <h3 class="card-title" style="margin-bottom:8px;">Motivo de Entrada no CLAS?</h3>
            <textarea id="inp-motivo" style="width:100%; min-height:80px; border:1px solid #d1d5db; border-radius:8px; padding:12px; font-family:inherit; resize:vertical;"><?= htmlspecialchars($membro->motivo_entrada ?? '') ?></textarea>
          </div>
          <div style="display:flex; gap:12px;">
            <button onclick="salvarCartao('inscricao')" class="btn-danger" style="background:#10b981; margin:0; width:auto; padding:8px 24px;">Guardar</button>
            <button onclick="toggleEdit('inscricao')" class="btn-white" style="margin:0; width:auto; padding:8px 24px; border:1px solid #d1d5db;">Cancelar</button>
          </div>
        </div>

        <div class="d-card">
          <h3 class="card-title" style="margin-bottom:24px;">Conquistas e Resenhas</h3>
          
          <!-- Secção Troféus -->
          <div style="margin-top:16px;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
              <h4 style="font-size:1.1rem; color:#1e293b; font-weight:600; margin:0;"><i class="ph ph-trophy" style="color:#f59e0b; margin-right:8px; font-size:1.3rem; vertical-align:middle;"></i>Troféus</h4>
              <button class="btn-white" title="Atribuir Troféu" style="font-size:0.85rem; padding:6px 12px; margin:0; width:auto; border:1px solid #d1d5db;"><i class="ph ph-plus" style="margin-right:4px;"></i>Atribuir</button>
            </div>
            
            <div style="display:flex; gap:16px; flex-wrap:wrap;">
              <!-- Placeholder Troféu -->
              <div style="background:#fffbeb; border:1px solid #fde68a; padding:12px 16px; border-radius:12px; display:flex; align-items:center; gap:12px; min-width:200px;">
                <div style="background:#fef3c7; color:#d97706; padding:12px; border-radius:50%; display:flex; align-items:center; justify-content:center;">
                  <i class="ph ph-book-open" style="font-size:1.5rem;"></i>
                </div>
                <div>
                  <h5 style="margin:0; font-size:0.95rem; font-weight:600; color:#92400e;">Leitor Voraz</h5>
                  <span style="font-size:0.8rem; color:#b45309;">10 Livros lidos</span>
                </div>
              </div>
              
              <!-- Placeholder Adicionar Novo -->
              <div style="border:1px dashed #cbd5e1; background:#f8fafc; padding:12px 16px; border-radius:12px; display:flex; align-items:center; justify-content:center; gap:8px; color:#64748b; cursor:pointer; transition:0.2s; min-width:180px;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#f8fafc'">
                <i class="ph ph-plus" style="font-size:1.2rem;"></i>
                <span style="font-size:0.9rem; font-weight:500;">Novo Troféu</span>
              </div>
            </div>
          </div>
          
          <!-- Secção Resenhas -->
          <div style="margin-top:36px;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
              <h4 style="font-size:1.1rem; color:#1e293b; font-weight:600; margin:0;"><i class="ph ph-pencil-line" style="color:#3b82f6; margin-right:8px; font-size:1.3rem; vertical-align:middle;"></i>Resenhas Recentes</h4>
            </div>
            
            <div style="display:flex; flex-direction:column; gap:12px;">
              <!-- Placeholder Resenha -->
              <div style="background:#f8fafc; border:1px solid #e2e8f0; padding:16px; border-radius:12px;">
                <div style="display:flex; justify-content:space-between; align-items:flex-start;">
                  <h5 style="margin:0 0 6px 0; font-size:1.05rem; font-weight:600; color:#0f172a;">O Alquimista</h5>
                </div>
                <p style="margin:0; font-size:0.9rem; color:#475569; line-height:1.5;">"Uma jornada fantástica sobre encontrar o nosso propósito. Adorei cada página e recomendo a todos no clube."</p>
                <div style="margin-top:10px; font-size:0.8rem; color:#64748b; display:flex;">
                  <span>24 de Junho, 2026</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="d-card d-card-purple">
         
        
        </div>

      </div>

      <!-- Modal Alterar Estado -->
      <div id="modalEstado" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999; align-items:center; justify-content:center;">
        <div style="background:#fff; width:90%; max-width:400px; border-radius:16px; padding:24px; box-shadow:0 20px 25px -5px rgba(0,0,0,0.1);">
          <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
            <h3 style="margin:0; font-size:1.2rem; color:#1e293b; font-weight:600;">Alterar Estado</h3>
            <button onclick="fecharModalEstado()" style="background:none; border:none; font-size:1.5rem; color:#64748b; cursor:pointer;">&times;</button>
          </div>
          <p style="color:#475569; font-size:0.95rem; margin-bottom:20px;">Selecione o novo estado para este membro:</p>
          
          <select id="select-novo-estado" style="width:100%; padding:10px 12px; border:1px solid #d1d5db; border-radius:8px; font-size:1rem; margin-bottom:24px;">
            <option value="ativo" <?= $membro->estado === 'ativo' ? 'selected' : '' ?>>Ativo</option>
            <option value="em risco" <?= $membro->estado === 'em risco' ? 'selected' : '' ?>>Em Risco</option>
            <option value="inativo" <?= $membro->estado === 'inativo' ? 'selected' : '' ?>>Inativo</option>
            <option value="fantasma" <?= $membro->estado === 'fantasma' ? 'selected' : '' ?>>Fantasma</option>
          </select>
          
          <div style="display:flex; gap:12px; justify-content:flex-end;">
            <button onclick="fecharModalEstado()" class="btn-white" style="margin:0; width:auto; padding:8px 16px; border:1px solid #d1d5db;">Cancelar</button>
            <button onclick="salvarEstado()" id="btn-salvar-estado" class="btn-danger" style="background:#10b981; margin:0; width:auto; padding:8px 16px;">Guardar</button>
          </div>
        </div>
      </div>

    </main>
  </div>

  <script>
    const membroId = <?= $membro->id ?>;

    function abrirModalEstado() {
      document.getElementById('modalEstado').style.display = 'flex';
    }
    
    function fecharModalEstado() {
      document.getElementById('modalEstado').style.display = 'none';
    }

    async function salvarEstado() {
      const select = document.getElementById('select-novo-estado');
      const novoEstado = select.value;
      const btn = document.getElementById('btn-salvar-estado');
      const originalText = btn.innerText;
      
      btn.innerText = 'A guardar...';
      btn.disabled = true;

      try {
        const response = await fetch('/admin/membros/atualizar', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ id: membroId, estado: novoEstado })
        });
        const result = await response.json();
        
        if(result.sucesso) {
          const badge = document.getElementById('badge-estado');
          badge.classList.remove('estado-ativo', 'estado-em-risco', 'estado-inativo', 'estado-fantasma');
          
          const estadoLabels = {
              'ativo': 'Ativo',
              'em risco': 'Em Risco',
              'inativo': 'Inativo',
              'fantasma': 'Fantasma'
          };
          const cssClass = novoEstado.replace(' ', '-');
          
          badge.classList.add(`estado-${cssClass}`);
          badge.innerText = estadoLabels[novoEstado];
          
          fecharModalEstado();
          
          Swal.fire({
            toast: true, position: 'top-end', icon: 'success',
            title: 'Estado atualizado!', showConfirmButton: false, timer: 2500
          });
        } else {
          Swal.fire('Erro', result.erro || 'Erro ao alterar estado.', 'error');
        }
      } catch (err) {
        Swal.fire('Erro', 'Falha na comunicação com o servidor.', 'error');
      } finally {
        btn.innerText = originalText;
        btn.disabled = false;
      }
    }

    function toggleEdit(cardId) {
      const viewDiv = document.getElementById(`view-${cardId}`);
      const editDiv = document.getElementById(`edit-${cardId}`);
      if(viewDiv.style.display === 'none') {
        viewDiv.style.display = 'block';
        editDiv.style.display = 'none';
      } else {
        viewDiv.style.display = 'none';
        editDiv.style.display = 'block';
      }
    }

    async function salvarCartao(cardId) {
      const btnSave = document.querySelector(`#edit-${cardId} .btn-danger`);
      const originalText = btnSave.innerText;
      btnSave.innerText = 'A guardar...';
      btnSave.disabled = true;

      let payload = { id: membroId };

      if(cardId === 'perfil') {
        payload.nome = document.getElementById('inp-nome').value;
        payload.numero_processo = document.getElementById('inp-numero_processo').value;
        payload.nome_passe = document.getElementById('inp-nome_passe').value;
        payload.email = document.getElementById('inp-email').value;
        payload.telefone = document.getElementById('inp-telefone').value;
        payload.telefone_alternativo = document.getElementById('inp-telefone_alternativo').value;
        payload.idade = document.getElementById('inp-idade').value;
      } else if(cardId === 'objetivos') {
        payload.objetivos_entrada = document.getElementById('inp-objetivos').value;
      } else if(cardId === 'inscricao') {
        payload.como_conheceu_clas = document.getElementById('inp-como_conheceu').value;
        payload.motivo_entrada = document.getElementById('inp-motivo').value;
      }
      
      try {
        const response = await fetch('/admin/membros/atualizar', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(payload)
        });
        const result = await response.json();
        
        if(result.sucesso) {
          if(cardId === 'perfil') {
            document.getElementById('txt-nome').innerText = payload.nome;
            document.getElementById('txt-numero_processo').innerHTML = `<strong>${payload.numero_processo}</strong>`;
            document.getElementById('txt-nome_passe').innerText = payload.nome_passe || 'N/A';
            document.getElementById('txt-email').innerText = payload.email;
            document.getElementById('txt-telefone').innerText = payload.telefone || 'N/A';
            document.getElementById('txt-telefone_alternativo').innerText = payload.telefone_alternativo || 'N/A';
          } else if(cardId === 'objetivos') {
            document.getElementById('txt-objetivos').innerHTML = payload.objetivos_entrada.replace(/\n/g, '<br>');
          } else if(cardId === 'inscricao') {
            document.getElementById('txt-como_conheceu').innerHTML = payload.como_conheceu_clas.replace(/\n/g, '<br>') || 'N/A';
            document.getElementById('txt-motivo').innerHTML = payload.motivo_entrada.replace(/\n/g, '<br>') || 'N/A';
          }
          
          toggleEdit(cardId);
          Swal.fire({
            toast: true, position: 'top-end', icon: 'success',
            title: 'Guardado com sucesso!', showConfirmButton: false, timer: 2500
          });
        } else {
          Swal.fire('Erro', result.erro || 'Ocorreu um erro ao guardar.', 'error');
        }
      } catch (err) {
        Swal.fire('Erro', 'Falha na comunicação com o servidor.', 'error');
      } finally {
        btnSave.innerText = originalText;
        btnSave.disabled = false;
      }
    }

    // Lógica básica UI
    document.addEventListener("DOMContentLoaded", function() {
      const userProfileBtn = document.getElementById("userProfileBtn");
      const userDropdown = document.getElementById("userDropdown");
      const mobileMenuBtn = document.getElementById("mobileMenuBtn");
      const sidebar = document.getElementById("sidebar");
      const sidebarOverlay = document.getElementById("sidebarOverlay");

      if (userProfileBtn && userDropdown) {
        userProfileBtn.addEventListener("click", function(e) {
          e.stopPropagation();
          userDropdown.classList.toggle("show");
        });
      }

      document.addEventListener("click", function(e) {
        if (userDropdown && userDropdown.classList.contains("show")) {
          if (!userProfileBtn.contains(e.target)) {
            userDropdown.classList.remove("show");
          }
        }
      });

      if (mobileMenuBtn && sidebar && sidebarOverlay) {
        mobileMenuBtn.addEventListener("click", function() {
          sidebar.classList.add("open");
          sidebarOverlay.classList.add("show");
        });
        sidebarOverlay.addEventListener("click", function() {
          sidebar.classList.remove("open");
          sidebarOverlay.classList.remove("show");
        });
      }
    });
  </script>
</body>
</html>
