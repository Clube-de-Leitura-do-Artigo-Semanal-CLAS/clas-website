<?php
/**
 * Front controller — TODOS os pedidos ao site passam por aqui.
 * Não adicionem lógica de negócio neste ficheiro; ele só carrega
 * o autoloader, arranca as rotas e despacha para o Controller certo.
 */

// Carrega variáveis de .env (usar phpdotenv ou parser simples)
$config = require __DIR__ . '/../config/database.php';

// Roteamento simples para testar as views públicas
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$routes = [
    '/'              => __DIR__ . '/../app/Views/publica/home.php',
    '/sobre'         => __DIR__ . '/../app/Views/publica/sobre.php',
    '/contacto'      => __DIR__ . '/../app/Views/publica/contacto.php',
    '/eventos'       => __DIR__ . '/../app/Views/publica/eventos.php',
];

if (isset($routes[$uri])) {
    require $routes[$uri];
} else {
    http_response_code(404);
    echo '<h1>404 — Página não encontrada</h1>';
}
