<?php

namespace App\Services;

/**
 * Recebe os relatórios de turma enviados pelo KwiZ via API — Tarefa 2.6.
 * Rota: POST /api/kwiz/relatorio (ver routes/api.php)
 *
 * O CLAS é o lado passivo desta integração: só recebe e regista.
 * A lógica do quiz em si vive no site do KwiZ, não aqui.
 */
class KwizIntegrationService
{
    public function receberRelatorio(array $payload): void
    {
        // TODO:
        // 1. Validar a API key do pedido
        // 2. Guardar o relatório
        // 3. Chamar EstadoMembroService::reativar() para cada membro envolvido
        // 4. Chamar TrofeuService::avaliarMelhorKwiz() se aplicável
    }
}
