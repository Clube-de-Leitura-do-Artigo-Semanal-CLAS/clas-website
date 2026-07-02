<?php
/**
 * Rotas do painel ADMIN — todas passam pelo RoleMiddleware.
 * Ver Tarefa 2.4 (roles) e 3.10 a 3.13 (telas de admin).
 */

return [
    ['GET',  '/admin/presencas', \App\Controllers\Admin\PresencasController::class, 'index'],
    ['POST', '/admin/presencas', \App\Controllers\Admin\PresencasController::class, 'marcar'],
    ['GET',  '/admin/membros', \App\Controllers\Admin\MembrosController::class, 'index'],
    ['GET',  '/admin/membros/{id}', \App\Controllers\Admin\MembrosController::class, 'show'],
    ['POST', '/admin/roles', \App\Controllers\Admin\RolesController::class, 'atribuir'],
    ['GET',  '/admin/estatisticas', \App\Controllers\Admin\EstatisticasController::class, 'index'],
];
