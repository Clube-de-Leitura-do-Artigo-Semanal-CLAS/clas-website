<?php

namespace App\Controllers\Admin;

/**
 * Marcação de presença — Tarefa 3.10.
 * A coordenadora marca debates, a receção marca eventos.
 * O RoleMiddleware garante que cada uma só marca o que lhe compete.
 */
class PresencasController
{
    public function index(): void
    {
        // TODO: mostrar lista de membros esperados na sessão/evento do dia
        require __DIR__ . '/../../Views/admin/presencas.php';
    }

    public function marcar(): void
    {
        // TODO: gravar presença e chamar EstadoMembroService::reativar()
    }
}
