<?php

namespace App\Middleware;

/**
 * Corre antes de qualquer rota /admin/*.
 * Verifica se o membro autenticado tem a role certa para aceder.
 * Ver Tarefa 2.4 e config/roles.php.
 */
class RoleMiddleware
{
    public function handle(string $rolaExigida): bool
    {
        // TODO: buscar a role do membro autenticado na sessão
        // e comparar com $rolaExigida usando config/roles.php
        return false;
    }
}
