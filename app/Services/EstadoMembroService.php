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
        $ultima = strtotime($ultimaAtividadeEm);
        if ($ultima === false) {
            return 'ativo';
        }

        $dias = (int) ((time() - $ultima) / 86400);

        if ($dias <= self::DIAS_ATIVO) {
            return 'ativo';
        }
        if ($dias <= self::DIAS_EM_RISCO) {
            return 'em_risco';
        }
        if ($dias <= self::DIAS_INATIVO) {
            return 'inativo';
        }
        return 'fantasma';
    }

    public function reativar(int $membroId): void
    {
        $pdo = \App\Services\Database::getInstance();
        $stmt = $pdo->prepare("UPDATE membros SET estado = 'ativo' WHERE id = :id AND estado != 'ativo'");
        $stmt->bindValue(':id', $membroId, \PDO::PARAM_INT);
        $stmt->execute();
    }
}
