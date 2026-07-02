# public/assets

Frontend puro — HTML/CSS/JS, sem build step. O que estiver aqui é servido tal
como está, diretamente pelo servidor.

## css/

- `main.css` — reset, variáveis (cores, tipografia), estilos partilhados por todas as camadas
- `publica.css` — só para as páginas públicas (home, sobre, concurso, parceiros)
- `membros.css` — só para a área autenticada de membros
- `admin.css` — só para o painel de gestão

Mantém os estilos específicos de cada camada no ficheiro certo, para não
carregar CSS de admin numa página pública sem necessidade.

## js/

- `main.js` — comportamento partilhado (menu mobile, etc.)
- `qr-scanner.js` — leitura do QR code do passe (usado no admin/receção)
- `admin-presencas.js` — lógica de marcação de presença em debates/eventos

Nota: "Try o Kwiz" não tem JS próprio — é apenas um link para o quiz de
demonstração no site do KwiZ (ver `config/links_externos.php`).

## img/galeria/

Fotos usadas na secção de galeria da página pública. Otimiza (comprime)
as imagens antes de commitar — evita ficheiros gigantes no repositório.
