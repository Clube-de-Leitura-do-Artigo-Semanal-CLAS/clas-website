<?php

namespace App\Jobs;

use App\Services\EstadoMembroService;

/**
 * Corre 1x por dia via cron (ver cron/recalcular_estados.php) — Tarefa 2.3.
 * Percorre todos os membros e atualiza o campo 'estado' de cada um,
 * usando as regras do EstadoMembroService.
 */
class RecalcularEstadosJob
{
    public function __construct(private EstadoMembroService $estadoService)
    {
    }

    public function run(): void
    {
        // TODO: buscar todos os membros, calcular novo estado de cada um,
        // gravar só os que mudaram (evitar writes desnecessários)
    }
}
