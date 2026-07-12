<?php

namespace App\Controllers\Publica;

use App\Services\MembroService;

/**
 * Lista pública de membros — Tarefa 3.2
 *
 * A página mostra primeiro o pódio (top 3 por leituras) e depois a lista
 * completa, ordenada por número de processo (ID).
 *
 * Só é mostrado o nome_passe (nome de exibição), nunca o nome completo.
 */
class ListaMembrosController
{
    public function index(): void
    {
        $todos = array_values(MembroService::todos());

        // Pódio: top 3 por leituras. Mostra sempre 3, mesmo que ainda não
        // haja pontuações (enquanto os dados de atividade não vierem do KwiZ/BD).
        $porLeituras = $todos;
        usort($porLeituras, fn($a, $b) => ($b['leituras'] ?? 0) <=> ($a['leituras'] ?? 0));
        $top3 = array_slice($porLeituras, 0, 3);

        // Lista completa: ordenada por número de processo (ordem de entrada no clube)
        $membros = $todos;
        usort($membros, fn($a, $b) => strcmp($a['numero_processo'] ?? '', $b['numero_processo'] ?? ''));

        require __DIR__ . '/../../Views/publica/membros.php';
    }
}
