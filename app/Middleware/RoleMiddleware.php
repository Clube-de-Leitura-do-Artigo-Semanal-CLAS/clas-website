<?php

namespace App\Middleware;

/**
 * Corre antes de qualquer rota protegida (ver Router::autorizado()).
 * Verifica se o utilizador autenticado tem a role pedida.
 * Ver Tarefa 2.4 e config/roles.php.
 *
 * Assume que o login (ainda por implementar) grava a role do
 * utilizador em $_SESSION['role'] no momento da autenticação.
 */
class RoleMiddleware
{
    public function handle(string $rolaExigida): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $rolaAtual = $_SESSION['role'] ?? null;

        if ($rolaAtual === null) {
            return false;
        }

        // 'admin' tem sempre acesso, independentemente da role pedida
        // (ver config/roles.php: 'admin' => ['*'])
        if ($rolaAtual === 'admin') {
            return true;
        }

        return $rolaAtual === $rolaExigida;
    }
}
