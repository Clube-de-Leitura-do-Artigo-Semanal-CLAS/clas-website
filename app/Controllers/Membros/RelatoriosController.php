<?php

namespace App\Controllers\Membros;

/**
 * Relatórios individuais completos + comunicados + leituras do mês
 * em curso — Tarefa 3.7.
 */
class RelatoriosController
{
    public function index(): void
    {
        require __DIR__ . '/../../Views/membros/relatorios.php';
    }
}
