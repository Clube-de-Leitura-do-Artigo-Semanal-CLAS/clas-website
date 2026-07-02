<?php

namespace App\Controllers\Admin;

/**
 * Dashboard de estatísticas gerais da comunidade — Tarefa 3.11.
 * Ex: nº de membros por estado, participação em debates/eventos/kwiz.
 */
class EstatisticasController
{
    public function index(): void
    {
        require __DIR__ . '/../../Views/admin/estatisticas.php';
    }
}
