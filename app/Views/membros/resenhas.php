<?php $title = 'Escrever Resenha — CLAS'; ?>
<?php ob_start(); ?>

<section style="padding: 2rem 1rem; min-height: 100vh; background: var(--clr-paper);">
  <div class="container" style="max-width: 640px;">

    <h1 style="font-family: 'Playfair Display', serif; font-weight: 700; font-size: 1.8rem; color: var(--clr-dark); margin: 0 0 1.5rem;">
      Escrever uma Resenha
    </h1>

    <div class="clas-card">
      <form method="POST" action="/membros/resenhas" style="display: flex; flex-direction: column; gap: 1rem;">
        <div>
          <label style="font-size: 0.8rem; font-weight: 700; color: var(--clr-text); display: block; margin-bottom: 4px;">Título do Livro</label>
          <input type="text" name="livro" required placeholder="Ex: Terra Sonâmbula"
            style="width: 100%; height: 44px; border: 1.5px solid var(--clr-border); border-radius: var(--radius-md); padding: 0 14px; font-family: 'Manrope', sans-serif; font-size: 0.85rem; outline: none;">
        </div>

        <div>
          <label style="font-size: 0.8rem; font-weight: 700; color: var(--clr-text); display: block; margin-bottom: 4px;">A tua resenha <span style="font-weight:400;color:var(--clr-muted);">(Markdown)</span></label>
          <div style="display:flex; gap:4px; margin-bottom: 6px; flex-wrap:wrap;">
            <button type="button" onclick="wrapText('**','**')" title="Negrito" style="padding:6px 10px;border:1px solid var(--clr-border);border-radius:4px;background:var(--clr-white);cursor:pointer;font-weight:700;">B</button>
            <button type="button" onclick="wrapText('*','*')" title="Itálico" style="padding:6px 10px;border:1px solid var(--clr-border);border-radius:4px;background:var(--clr-white);cursor:pointer;font-style:italic;">I</button>
            <button type="button" onclick="wrapText('### ','')" title="Título" style="padding:6px 10px;border:1px solid var(--clr-border);border-radius:4px;background:var(--clr-white);cursor:pointer;font-weight:700;font-size:0.9rem;">H</button>
            <button type="button" onclick="wrapText('[','](url)')" title="Link" style="padding:6px 10px;border:1px solid var(--clr-border);border-radius:4px;background:var(--clr-white);cursor:pointer;">Link</button>
            <button type="button" onclick="wrapText('> ','')" title="Citação" style="padding:6px 10px;border:1px solid var(--clr-border);border-radius:4px;background:var(--clr-white);cursor:pointer;">"</button>
            <button type="button" onclick="wrapText('`','`')" title="Código" style="padding:6px 10px;border:1px solid var(--clr-border);border-radius:4px;background:var(--clr-white);cursor:pointer;font-family:monospace;">&lt;/&gt;</button>
          </div>
          <div style="display:flex;gap:8px;">
            <textarea id="resenhaTexto" name="texto" required placeholder="Escreve a tua resenha..." rows="8"
              oninput="previewMarkdown(this.value)"
              style="flex:1; border: 1.5px solid var(--clr-border); border-radius: var(--radius-md); padding: 12px 14px; font-family: 'Manrope', sans-serif; font-size: 0.85rem; outline: none; resize: vertical;"></textarea>
            <div id="resenhaPreview" style="flex:1; border: 1.5px solid var(--clr-border); border-radius: var(--radius-md); padding: 12px 14px; font-size: 0.85rem; line-height: 1.6; background: #fafafa; overflow-y: auto; min-height: 250px; color: #333; font-family: 'Playfair Display', serif;">
              <span style="color:var(--clr-muted);font-family:'Manrope',sans-serif;">Pré-visualização...</span>
            </div>
          </div>
        </div>

        <button type="submit" style="align-self: flex-start; padding: 12px 28px; border: none; border-radius: 16px; background: #1B4F8C; color: #fff; font-weight: 700; cursor: pointer; font-family: 'Manrope', sans-serif; font-size: 0.9rem;">
          Submeter Resenha
        </button>
      </form>
    </div>

    <p style="text-align:center;margin-top:1.5rem;">
      <a href="/membros/card" style="font-size:0.8rem;color:var(--clr-muted);font-family:'Manrope',sans-serif;">← Voltar ao meu perfil</a>
    </p>

  </div>
</section>

<script>
function wrapText(before, after) {
  const ta = document.getElementById('resenhaTexto');
  const start = ta.selectionStart;
  const end = ta.selectionEnd;
  const sel = ta.value.substring(start, end);
  ta.value = ta.value.substring(0, start) + before + sel + after + ta.value.substring(end);
  ta.focus();
  ta.selectionStart = start + before.length;
  ta.selectionEnd = start + before.length + sel.length;
  previewMarkdown(ta.value);
}

function previewMarkdown(text) {
  const html = text
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/^### (.+)$/gm, '<h3 style="font-size:1.1rem;font-weight:700;margin:8px 0 4px;">$1</h3>')
    .replace(/^## (.+)$/gm, '<h2 style="font-size:1.2rem;font-weight:700;margin:10px 0 4px;">$1</h2>')
    .replace(/^# (.+)$/gm, '<h1 style="font-size:1.3rem;font-weight:700;margin:12px 0 4px;">$1</h1>')
    .replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>')
    .replace(/\*(.+?)\*/g, '<em>$1</em>')
    .replace(/`(.+?)`/g, '<code style="background:#eee;padding:2px 4px;border-radius:3px;font-size:0.8em;">$1</code>')
    .replace(/^> (.+)$/gm, '<blockquote style="border-left:3px solid var(--clr-accent);padding-left:12px;color:var(--clr-muted);margin:8px 0;">$1</blockquote>')
    .replace(/!\[(.+?)\]\((.+?)\)/g, '<img src="$2" alt="$1" style="max-width:100%;border-radius:6px;margin:8px 0;">')
    .replace(/\[(.+?)\]\((.+?)\)/g, '<a href="$2" target="_blank" style="color:var(--clr-accent);">$1</a>')
    .split('\n').filter(l => l.trim()).join('<br>');

  document.getElementById('resenhaPreview').innerHTML = html || '<span style="color:var(--clr-muted);font-family:\'Manrope\',sans-serif;">Pré-visualização...</span>';
}
</script>

<?php $content = ob_get_clean(); ?>
<?php require __DIR__ . '/../layouts/publica.php'; ?>
