<?php

/**
 * Front controller — TODOS os pedidos passam por aqui (ver .htaccess).
 *
 * Fluxo:
 *   1. Carrega configuração e autoload
 *   2. Resolve a rota pedida (routes/web.php, routes/admin.php, routes/api.php)
 *   3. Chama o Controller correspondente
 *
 * Ainda não implementado — este ficheiro é o ponto de partida.
 * Quem pegar na tarefa de routing/bootstrap deve substituir isto por
 * um router real (mesmo que simples, feito à mão).
 */

require_once __DIR__ . '/../app/bootstrap.php';

// TODO: resolver rota e despachar para o Controller certo.
// Ver routes/web.php, routes/admin.php e routes/api.php.
