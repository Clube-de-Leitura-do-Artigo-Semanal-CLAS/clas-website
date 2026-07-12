<!DOCTYPE html>
<html lang="pt-AO">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CLAS — Login</title>
  <link rel="icon" href="/assets/img/logo_clas.png" type="image/gif" />
  <meta name="description" content="Inicia a tua sessão no CLAS." />
  <link rel="stylesheet" href="/assets/css/login.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="login-page">

  <div class="login-card">
    <div class="login-left">
      <a href="/index.html">
        <img src="/assets/img/logo_clas.png" alt="CLAS Logo" />
      </a>
    </div>
    
    <div class="login-right">
      <h1 class="login-title">Login</h1>
      <p class="login-subtitle">Já é membro mas ainda não iniciaste a sessão? <a href="javascript:void(0)" onclick="abrirModalAtivacao()">Activar Conta</a></p>
      
      <form class="login-form" action="/login" method="POST">
        <div class="form-group">
          <input type="text" name="email" placeholder="Email ou ID CLAS" required />
        </div>
        <div class="form-group">
          <input type="password" name="password" placeholder="Palavra-passe" required />
        </div>
        
        <div class="login-options">
          <label>
            <input type="checkbox" name="remember" /> Manter sessão iniciada
          </label>
        </div>
        
        <button type="submit" class="btn-login-submit">ENTRAR</button>
        
        <div class="login-forgot-wrap">
          <a href="#" class="login-forgot">Esqueceste-te da palavra-passe?</a>
        </div>
      </form>
      </div>
    </div>
  </div>

  <!-- MODAL SPA DE ATIVAÇÃO -->
  <div id="spaModalOverlay" class="spa-modal-overlay">
    <div class="spa-modal">
      <button class="spa-close" onclick="fecharModalAtivacao()">&times;</button>
      
      <div class="spa-slider-wrapper">
        <div class="spa-slider" id="spaSlider">
          
          <!-- Passo 1: Identidade -->
          <div class="spa-slide">
            <h2>Primeiro Acesso ao CLAS</h2>
            <p>Para ativar a tua conta digital, precisamos de confirmar a tua identidade.</p>
            <div class="form-group" style="margin-top: 20px;">
              <input type="text" id="spa_identificador" placeholder="Email ou ID CLAS (Ex: CLAS0001)" />
            </div>
            <button class="btn-login-submit" onclick="enviarPasso1()" id="btnPasso1">Continuar</button>
            <div id="spa_erro1" class="spa-erro"></div>
          </div>

          <!-- Passo 2: OTP -->
          <div class="spa-slide">
            <h2>Verificação de Segurança</h2>
            <p id="spa_info_otp" style="font-size: 0.9em; background: #eef5ff; padding: 10px; border-radius: 6px; margin-bottom: 15px; color: #333;"></p>
            <div class="form-group">
              <input type="text" id="spa_otp" placeholder="000000" maxlength="6" style="text-align: center; letter-spacing: 5px; font-size: 20px;" />
            </div>
            <button class="btn-login-submit" onclick="enviarPasso2()" id="btnPasso2">Validar Código</button>
            <div id="spa_erro2" class="spa-erro"></div>
            <a href="javascript:void(0)" onclick="voltarPasso1()" style="display:block; margin-top: 10px; font-size:0.85em; color: #555;">&larr; Voltar e tentar outro Email</a>
          </div>

          <!-- Passo 3: Senha -->
          <div class="spa-slide">
            <h2>Criar Palavra-passe</h2>
            <p>Identidade confirmada! Define uma senha para entrares no sistema no futuro.</p>
            <div class="form-group" style="margin-top: 15px;">
              <input type="password" id="spa_senha1" placeholder="Nova palavra-passe (Mínimo 6)" />
            </div>
            <div class="form-group">
              <input type="password" id="spa_senha2" placeholder="Confirmar palavra-passe" />
            </div>
            <button class="btn-login-submit" onclick="enviarPasso3()" id="btnPasso3">Concluir Ativação</button>
            <div id="spa_erro3" class="spa-erro"></div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <style>
    /* Estilos base para não afetar o teu CSS e focar apenas no Modal */
    .spa-modal-overlay {
      position: fixed; top: 0; left: 0; width: 100vw; height: 100vh;
      background: rgba(0,0,0,0.6); backdrop-filter: blur(4px);
      display: none; align-items: center; justify-content: center; z-index: 9999;
      opacity: 0; transition: opacity 0.3s;
    }
    .spa-modal-overlay.active { display: flex; opacity: 1; }
    
    .spa-modal {
      background: #fff; width: 90%; max-width: 450px; border-radius: 12px;
      padding: 30px; position: relative; box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }
    .spa-close {
      position: absolute; top: 15px; right: 15px; background: none; border: none;
      font-size: 24px; cursor: pointer; color: #888;
    }
    
    .spa-slider-wrapper { overflow: hidden; width: 100%; position: relative; }
    .spa-slider {
      display: flex; width: 300%; /* 3 slides de 100% cada */
      transition: transform 0.4s cubic-bezier(0.25, 1, 0.5, 1);
    }
    .spa-slide { width: 33.333%; padding: 0 10px; box-sizing: border-box; text-align: center; }
    .spa-slide h2 { color: #111; margin-bottom: 10px; font-size: 1.5em; }
    .spa-slide p { color: #666; margin-bottom: 15px; font-size: 0.95em; line-height: 1.4; }
    
    .spa-erro { color: #d93025; font-size: 0.85em; margin-top: 10px; min-height: 20px; }
    
    /* Reutiliza o estilo do teu input/button */
    .spa-slide input {
      width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px;
      outline: none; transition: border 0.2s;
    }
    .spa-slide input:focus { border-color: #0055ff; }
  </style>

  <script>
    const overlay = document.getElementById('spaModalOverlay');
    const slider = document.getElementById('spaSlider');

    function abrirModalAtivacao() {
      overlay.style.display = 'flex';
      setTimeout(() => overlay.classList.add('active'), 10);
      slider.style.transform = 'translateX(0%)';
      document.getElementById('spa_identificador').value = '';
      limparErros();
    }

    function fecharModalAtivacao() {
      overlay.classList.remove('active');
      setTimeout(() => overlay.style.display = 'none', 300);
    }

    function limparErros() {
      document.getElementById('spa_erro1').innerText = '';
      document.getElementById('spa_erro2').innerText = '';
      document.getElementById('spa_erro3').innerText = '';
    }

    async function enviarPasso1() {
      const id = document.getElementById('spa_identificador').value;
      const btn = document.getElementById('btnPasso1');
      limparErros();

      if (!id) return document.getElementById('spa_erro1').innerText = 'Preenche o campo.';
      
      btn.innerText = 'A aguardar...'; btn.disabled = true;
      try {
        const res = await fetch('/ativar/verificar-identidade', {
          method: 'POST', headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ identificador: id })
        });
        const data = await res.json();
        
        if (data.sucesso) {
          document.getElementById('spa_info_otp').innerHTML = `SMS enviado para o número terminado em <b>${data.telefoneOculto}</b>.`;
          slider.style.transform = 'translateX(-33.333%)'; // Desliza para o Passo 2
        } else {
          document.getElementById('spa_erro1').innerText = data.erro;
        }
      } catch (e) {
        document.getElementById('spa_erro1').innerText = 'Erro de comunicação.';
      }
      btn.innerText = 'Continuar'; btn.disabled = false;
    }

    function voltarPasso1() {
      slider.style.transform = 'translateX(0%)';
      limparErros();
    }

    async function enviarPasso2() {
      const otp = document.getElementById('spa_otp').value;
      const btn = document.getElementById('btnPasso2');
      limparErros();

      if (!otp) return document.getElementById('spa_erro2').innerText = 'Preenche o OTP.';
      
      btn.innerText = 'A validar...'; btn.disabled = true;
      try {
        const res = await fetch('/ativar/verificar-otp', {
          method: 'POST', headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ otp: otp })
        });
        const data = await res.json();
        
        if (data.sucesso) {
          slider.style.transform = 'translateX(-66.666%)'; // Desliza para o Passo 3
        } else {
          document.getElementById('spa_erro2').innerText = data.erro;
        }
      } catch (e) {
        document.getElementById('spa_erro2').innerText = 'Erro de comunicação.';
      }
      btn.innerText = 'Validar Código'; btn.disabled = false;
    }

    async function enviarPasso3() {
      const senha1 = document.getElementById('spa_senha1').value;
      const senha2 = document.getElementById('spa_senha2').value;
      const btn = document.getElementById('btnPasso3');
      limparErros();
      
      btn.innerText = 'A registar...'; btn.disabled = true;
      try {
        const res = await fetch('/ativar/concluir', {
          method: 'POST', headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ senha: senha1, confirmar_senha: senha2 })
        });
        const data = await res.json();
        
        if (data.sucesso) {
          fecharModalAtivacao();
          Swal.fire({
            icon: 'success',
            title: 'Parabéns!',
            text: data.mensagem,
            confirmButtonText: 'Fazer Login'
          }).then(() => {
            document.querySelector('input[name="email"]').value = document.getElementById('spa_identificador').value;
            document.querySelector('input[name="password"]').value = senha1;
          });
        } else {
          document.getElementById('spa_erro3').innerText = data.erro;
        }
      } catch (e) {
        document.getElementById('spa_erro3').innerText = 'Erro de comunicação.';
      }
      btn.innerText = 'Concluir Ativação'; btn.disabled = false;
    }
  </script>

</body>
</html>
