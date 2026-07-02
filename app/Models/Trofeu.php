<?php

namespace App\Models;

/**
 * Troféu/badge atribuído a um membro.
 * Ver Tarefa 2.7 — regras automáticas (ex: melhor resultado num Kwiz,
 * presença em todos os debates de um período).
 */
class Trofeu
{
    public int $id;
    public int $membroId;
    public string $tipo;      // identifica a regra que o gerou
    public string $atribuidoEm;
}
