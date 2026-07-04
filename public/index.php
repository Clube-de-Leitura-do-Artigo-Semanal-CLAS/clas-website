<?php
/**
 * Front controller — TODOS os pedidos ao site passam por aqui.
 * Não adicionem lógica de negócio neste ficheiro; ele só carrega
 * o autoloader, arranca as rotas e despacha para o Controller certo.
 */

require_once __DIR__ . '/../vendor/autoload.php'; // se vierem a usar Composer

// Carrega variáveis de .env (usar phpdotenv ou parser simples)
$config = require __DIR__ . '/../config/database.php';

// Carrega as rotas — cada ficheiro define um pedaço do site
require __DIR__ . '/../routes/web.php';
require __DIR__ . '/../routes/admin.php';
require __DIR__ . '/../routes/api.php';

// TODO: instanciar o router e despachar o pedido atual
// Ex: $router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
