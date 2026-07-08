<?php

namespace App\Controllers\Publica;

use App\Services\MembroExemploService;

/**
 * Lista pública de membros — Tarefa 3.2
 */
class ListaMembrosController
{
    public function index(): void
    {
        $membros = array_values(MembroExemploService::todos());

        usort($membros, fn($a, $b) => $b['leituras'] <=> $a['leituras']);
        $top3 = array_slice($membros, 0, 3);

        require __DIR__ . '/../../Views/publica/membros.php';
    }
}