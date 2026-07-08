<?php
/**
 * Rotas do painel ADMIN.
 *
 * O 5º elemento de cada rota é a lista de roles permitidas —
 * o Router (app/Core/Router.php) usa isto para chamar o
 * RoleMiddleware antes de despachar. Ver Tarefa 2.4.
 *
 * Presenças: coordenadora marca debates, receção marca eventos,
 * mas ambas partilham a mesma rota/Controller (a distinção de
 * tipo 'debate' vs 'evento' é feita dentro do PresencasController,
 * não aqui nas rotas).
 */

return [
    ['GET',  '/admin/presencas', \App\Controllers\Admin\PresencasController::class, 'index', ['coordenadora', 'rececao', 'admin']],
    ['POST', '/admin/presencas', \App\Controllers\Admin\PresencasController::class, 'marcar', ['coordenadora', 'rececao', 'admin']],
    ['GET',  '/admin/membros', \App\Controllers\Admin\MembrosController::class, 'index', ['']],
    ['GET',  '/admin/membros/{id}', \App\Controllers\Admin\MembrosController::class, 'show', ['admin']],
    ['POST', '/admin/membros/role', \App\Controllers\Admin\MembrosController::class, 'updateRole', ['admin']],
    ['POST', '/admin/roles', \App\Controllers\Admin\RolesController::class, 'atribuir', ['admin']],
    ['GET',  '/admin/estatisticas', \App\Controllers\Admin\EstatisticasController::class, 'index', ['admin']],
];
