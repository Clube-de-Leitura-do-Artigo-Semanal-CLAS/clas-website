<?php

namespace App\Models;

/**
 * Representa um membro do CLAS.
 * Ver secção 3 do documento de visão — "Modelo do membro".
 *
 * Campos principais: numero_processo, qr_code, estado, objetivos_entrada,
 * historico literário (relacionado com livros/eventos/troféus/badges).
 */
class Membro
{
    public int $id;
    public string $numeroProcesso;
    public string $qrCode;
    public string $estado; // ativo | em_risco | inativo | fantasma — Tarefa 2.2
    public ?string $objetivosEntrada;
    public string $criadoEm;

    // TODO: métodos de acesso à BD (find, save, etc.)
    // Sugestão: manter aqui só o mapeamento; puxar a lógica de estado
    // para Services/EstadoMembroService.php, não para o Model.
}
