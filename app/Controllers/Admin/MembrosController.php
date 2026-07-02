<?php

namespace App\Controllers\Admin;

/**
 * Gestão de membros e dos seus estados — Tarefa 3.12.
 */
class MembrosController
{
    public function index(): void
    {
        require __DIR__ . '/../../Views/admin/membros.php';
    }

    public function show(string $id): void
    {
        require __DIR__ . '/../../Views/admin/membro_detalhe.php';
    }
}
