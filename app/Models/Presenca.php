<?php

namespace App\Models;

/**
 * Uma presença marcada — em debate ou em evento.
 * Quem marca depende da role: coordenadora (debates) ou receção (eventos).
 */
class Presenca
{
    public int $id;
    public int $membroId;
    public string $tipo;       // 'debate' | 'evento'
    public string $data;
    public int $marcadoPorId;  // id do utilizador (coordenadora/receção) que marcou
}
