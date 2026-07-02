<?php

/**
 * config/database.php
 * Lê os dados de ligação a partir do .env — nunca colocar credenciais
 * diretamente aqui.
 */

return [
    'host'     => $_ENV['DB_HOST']     ?? '127.0.0.1',
    'port'     => $_ENV['DB_PORT']     ?? '3306',
    'database' => $_ENV['DB_DATABASE'] ?? '',
    'username' => $_ENV['DB_USERNAME'] ?? '',
    'password' => $_ENV['DB_PASSWORD'] ?? '',
];
