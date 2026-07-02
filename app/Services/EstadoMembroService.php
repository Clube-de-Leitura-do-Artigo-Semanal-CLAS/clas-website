<?php

namespace App\Services;

/**
 * O CORAÇÃO do sistema de atividade dos membros — Tarefa 2.2.
 *
 * Regra definida em equipa:
 *   0–45 dias sem nenhuma das 3 frentes  -> ativo
 *   45–60 dias                            -> em_risco
 *   60 dias–3 meses                       -> inativo
 *   3+ meses                              -> fantasma
 *
 * As 3 frentes que contam: presença em debate, presença em evento,
 * participação em Kwiz (via relatório recebido do KwiZ).
 *
 * Reativação: automática. Basta 1 participação em qualquer frente
 * para o membro voltar a "ativo", independente do estado anterior.
 *
 * Este service é chamado pelo Job de cron (Tarefa 2.3) e também
 * imediatamente sempre que uma nova presença/relatório entra.
 */
class EstadoMembroService
{
    private const DIAS_ATIVO = 45;
    private const DIAS_EM_RISCO = 60;
    private const DIAS_INATIVO = 90; // 3 meses

    public function calcularEstado(string $ultimaAtividadeEm): string
    {
        // TODO: calcular diferença de dias entre $ultimaAtividadeEm e hoje,
        // devolver 'ativo' | 'em_risco' | 'inativo' | 'fantasma'
        return 'ativo';
    }

    public function reativar(int $membroId): void
    {
        // Chamado assim que chega uma nova presença/relatório de Kwiz
        // para este membro. Repõe o estado para 'ativo' de imediato.
    }
}
