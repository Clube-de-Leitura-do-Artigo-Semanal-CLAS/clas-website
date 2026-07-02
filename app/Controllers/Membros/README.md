# Controllers/Membros

Área autenticada — cada membro só vê os seus próprios dados.
Corresponde às tarefas 3.5 a 3.9 do Project.

Controllers a criar aqui:

- `AuthController.php` — login ligado ao número de processo (3.5)
- `CardController.php` — card do membro, acedido também via QR code (3.6)
- `PerfilController.php` — perfil, histórico literário (troféus, badges, livros) (3.6)
- `RelatoriosController.php` — relatórios individuais, comunicados, leituras do mês (3.7)
- `ResenhasController.php` — publicar e ver resenhas (3.8)
- `BibliotecaController.php` — link/incorporação da Biblioteca (drive) (3.9)

Lembrete: todos os Controllers desta pasta devem confirmar que o
utilizador está autenticado antes de mostrar qualquer dado (ver
Middleware/).
