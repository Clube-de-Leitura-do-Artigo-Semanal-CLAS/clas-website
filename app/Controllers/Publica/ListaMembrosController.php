<?php

namespace App\Controllers\Publica;

use App\Services\MembroExemploService;

/**
 * Lista pública de membros — Tarefa 3.2
 *
 * Mostra apenas o nome_passe (nome de exibição), nunca o nome completo.
 * A ordenação por defeito é por número de processo (ordem de entrada no clube);
 * o pódio (top 3) é por número de leituras.
 */
class ListaMembrosController
{
    public function index(): void
    {
        $membros = array_values(MembroExemploService::todos());

        // Pódio: os 3 com mais leituras (só entram membros com leituras > 0,
        // para não mostrar um pódio de zeros enquanto não há dados reais).
        $comLeituras = array_filter($membros, fn($m) => ($m['leituras'] ?? 0) > 0);
        usort($comLeituras, fn($a, $b) => ($b['leituras'] ?? 0) <=> ($a['leituras'] ?? 0));
        $top3 = array_slice(array_values($comLeituras), 0, 3);

        // Lista principal: ordenada por número de processo (ordem de entrada)
        usort($membros, fn($a, $b) => strcmp($a['numero_processo'] ?? '', $b['numero_processo'] ?? ''));

        require __DIR__ . '/../../Views/publica/membros.php';
    }
}
