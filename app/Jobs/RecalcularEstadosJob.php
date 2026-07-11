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
        $pdo = \App\Services\Database::getInstance();

        $membros = $pdo->query("SELECT id FROM membros")->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($membros as $m) {
            $id = $m['id'];

            $stmt = $pdo->prepare("
                SELECT GREATEST(
                    COALESCE((SELECT MAX(data) FROM presencas WHERE membro_id = :id1), '1970-01-01'),
                    COALESCE((SELECT MAX(recebido_em) FROM kwiz_relatorios WHERE membro_id = :id2), '1970-01-01')
                ) AS ultima
            ");
            $stmt->bindValue(':id1', $id, \PDO::PARAM_INT);
            $stmt->bindValue(':id2', $id, \PDO::PARAM_INT);
            $stmt->execute();

            $ultima = $stmt->fetchColumn();

            $novoEstado = $this->estadoService->calcularEstado($ultima);

            $stmtUp = $pdo->prepare("UPDATE membros SET estado = :estado WHERE id = :id AND estado != :estado");
            $stmtUp->bindValue(':estado', $novoEstado);
            $stmtUp->bindValue(':id', $id, \PDO::PARAM_INT);
            $stmtUp->execute();
        }
    }
}
