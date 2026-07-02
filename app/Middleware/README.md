# Middleware

Código que corre ANTES do Controller, para validar algo comum a várias
rotas.

- `RoleMiddleware.php` (2.4)
  Confirma que o utilizador autenticado tem o role certo antes de deixar
  a rota continuar. Usado em todas as rotas de Admin, e também nas rotas
  de marcação de presença (só coordenadora marca debates, só receção
  marca eventos — mesmo sendo ambas "role de gestão", não têm as mesmas
  permissões entre si).
