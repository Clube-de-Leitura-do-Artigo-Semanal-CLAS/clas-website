<?php
/**
 * Configuração de ligação à base de dados.
 * Lê do .env — nunca metam credenciais diretamente aqui.
 */

return [
    'host' => getenv('DB_HOST') ?: '127.0.0.1',
    'name' => getenv('DB_NAME') ?: 'clas_website',
    'user' => getenv('DB_USER') ?: 'root',
    'pass' => getenv('DB_PASS') ?: '',
    'charset' => 'utf8mb4',
];
