# Controllers/Admin

Painel de gestão, acesso controlado por role.
Corresponde às tarefas 3.10 a 3.13 do Project.

Controllers a criar aqui:

- `PresencasController.php` — marcação de presença em debates (role: coordenadora)
  e eventos (role: receção) (3.10)
- `EstatisticasController.php` — dashboard de estatísticas gerais (3.11)
- `MembrosController.php` — gestão de estado dos membros (3.12)
- `RolesController.php` — atribuição de roles (3.12)
- `BibliotecaController.php` — gestão de biblioteca/livro do mês (3.13)

Todos os métodos aqui devem passar primeiro por Middleware/RoleMiddleware.php
— confirma que o role de quem está autenticado tem permissão para a ação
antes de executar qualquer coisa.
