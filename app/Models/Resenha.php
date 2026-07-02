<?php

namespace App\Models;

/**
 * Resenha de livro publicada por um membro.
 * Ver Tarefa 2.8. Tem estado de moderação — decisão em aberto no
 * documento de visão (livre vs. aprovação manual).
 */
class Resenha
{
    public int $id;
    public int $membroId;
    public string $livro;
    public string $texto;
    public string $estadoModeracao; // 'pendente' | 'aprovada' | 'rejeitada'
    public string $criadaEm;
}
