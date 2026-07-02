<?php

namespace App\Controllers\Membros;

/**
 * Perfil do membro autenticado — Tarefa 3.6.
 * Exige sessão ativa (verificar antes de renderizar).
 */
class PerfilController
{
    public function index(): void
    {
        require __DIR__ . '/../../Views/membros/perfil.php';
    }
}
