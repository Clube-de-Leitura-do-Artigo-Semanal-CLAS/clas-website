<?php

namespace App\Services;

/**
 * Constrói dados exemplares de membros a partir de docs/membros.json.
 * O JSON é gerado localmente a partir de CLASID.xlsx e NÃO sobe para o GitHub.
 */
class MembroExemploService
{
    private static ?array $cache = null;

    public static function todos(): array
    {
        if (self::$cache !== null) {
            return self::$cache;
        }

        $caminho = __DIR__ . '/../../docs/membros.json';
        if (!file_exists($caminho)) {
            self::$cache = [];
            return self::$cache;
        }

        $json = file_get_contents($caminho);
        $dados = json_decode($json, true);
        self::$cache = is_array($dados) ? $dados : [];
        return self::$cache;
    }

    public static function buscar(string $id): ?array
    {
        $todos = self::todos();
        return $todos[$id] ?? null;
    }
}