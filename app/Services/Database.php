<?php

namespace App\Services;

use PDO;
use PDOException;

/**
 * Serviço de ligação à base de dados (Supabase / PostgreSQL).
 *
 * Implementa o padrão Singleton para garantir que só existe uma
 * instância PDO activa durante o ciclo de vida de cada pedido.
 *
 * Uso em qualquer Model ou Controller:
 *
 *   $pdo = Database::getInstance();
 *   $stmt = $pdo->prepare('SELECT * FROM membros WHERE id = :id');
 *   $stmt->execute([':id' => $id]);
 */
class Database
{
    private static ?PDO $instance = null;

    /**
     * Impede instanciação directa — usa Database::getInstance().
     */
    private function __construct() {}

    /**
     * Devolve a instância PDO partilhada, criando-a na primeira chamada.
     *
     * @throws \RuntimeException se a ligação falhar.
     */
    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            self::$instance = self::connect();
        }

        return self::$instance;
    }

    /**
     * Cria e configura a ligação PDO ao Supabase (PostgreSQL).
     */
    private static function connect(): PDO
    {
        $cfg = require __DIR__ . '/../../config/database.php';

        $dsn = sprintf(
            'pgsql:host=%s;port=%s;dbname=%s',
            $cfg['host'],
            $cfg['port'],
            $cfg['name']
        );

        try {
            $pdo = new PDO($dsn, $cfg['user'], $cfg['pass'], [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
                PDO::ATTR_PERSISTENT         => true, // Mantém a ligação viva entre refreshes
            ]);

            // Define o schema de pesquisa (search_path) para o schema configurado.
            // Garante que as queries sem prefixo de schema (ex: SELECT * FROM membros)
            // resolvem para o schema correcto no Supabase.
            $schema = $cfg['schema'];
            $pdo->exec("SET search_path TO {$schema}");

            return $pdo;
        } catch (PDOException $e) {
            // Temporariamente vamos mostrar o erro real para debug
            throw new \RuntimeException('Erro PDO: ' . $e->getMessage());
        }
    }
}
