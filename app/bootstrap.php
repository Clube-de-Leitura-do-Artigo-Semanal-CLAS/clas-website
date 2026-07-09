<?php

/**
 * app/bootstrap.php
 *
 * Ponto de arranque da aplicação: carrega variáveis de ambiente,
 * regista o autoloader PSR-4 e disponibiliza a ligação à BD.
 */

// --- 1. Autoload (Composer PSR-4) ---
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
}

// --- 2. Carregar .env ---
// Lê o ficheiro .env da raiz do projecto e popula getenv() / $_ENV.
// Se estiveres em produção no Supabase/servidor, as variáveis já estão
// definidas no ambiente — o bloco seguinte apenas as carrega em local.
$envFile = __DIR__ . '/../.env';
if (file_exists($envFile)) {
    foreach (file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        // Ignora comentários
        if (str_starts_with(trim($line), '#')) {
            continue;
        }
        if (str_contains($line, '=')) {
            [$key, $value] = explode('=', $line, 2);
            $key   = trim($key);
            $value = trim($value);
            if (!array_key_exists($key, $_ENV)) {
                putenv("{$key}={$value}");
                $_ENV[$key] = $value;
            }
        }
    }
}

// --- 3. Ligação à BD ---
// A ligação não é aberta aqui directamente — o singleton Database::getInstance()
// é chamado apenas quando é necessário (lazy connection).
// Referência: app/Services/Database.php
