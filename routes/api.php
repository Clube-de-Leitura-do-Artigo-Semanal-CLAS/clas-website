<?php
/**
 * Endpoints chamados por SERVIÇOS EXTERNOS (não por browsers).
 * Tarefa 2.6 — o KwiZ envia (POST) os relatórios de turma para aqui.
 *
 * Proteger com uma chave partilhada (API key) enviada no header,
 * NÃO usar sessão de membro aqui.
 */

return [
    ['POST', '/api/kwiz/relatorio', \App\Services\KwizIntegrationService::class, 'receberRelatorio'],
];
