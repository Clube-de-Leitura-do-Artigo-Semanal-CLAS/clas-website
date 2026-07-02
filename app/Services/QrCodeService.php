<?php

namespace App\Services;

/**
 * Gera o QR code de cada membro e resolve a leitura de volta para o card.
 * Ver Tarefa 2.5.
 *
 * O QR aponta para algo como: /membros/card/{numero_processo}
 * Sugestão de lib (avaliar em equipa): endroid/qr-code via Composer.
 */
class QrCodeService
{
    public function gerarParaMembro(string $numeroProcesso): string
    {
        // TODO: gerar imagem do QR code e devolver o caminho/URL onde ficou guardado
        return '';
    }
}
