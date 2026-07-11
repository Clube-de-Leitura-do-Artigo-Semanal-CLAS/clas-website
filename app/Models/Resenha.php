<?php

namespace App\Models;

/**
 * Resenha de livro publicada por um membro.
 * Ver Tarefa 2.8. Tem estado de moderação — aprovação prévia com edição.
 */
class Resenha
{
    public int $id;
    public int $membroId;
    public string $livro;
    public string $texto;
    public string $estadoModeracao;
    public string $criadaEm;

    public static function criar(int $membroId, string $livro, string $texto): ?int
    {
        $pdo = \App\Services\Database::getInstance();
        $stmt = $pdo->prepare("
            INSERT INTO resenhas (membro_id, livro, texto, estado_moderacao)
            VALUES (:membro_id, :livro, :texto, 'pendente')
            RETURNING id
        ");
        $stmt->bindValue(':membro_id', $membroId, \PDO::PARAM_INT);
        $stmt->bindValue(':livro', $livro);
        $stmt->bindValue(':texto', $texto);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    public static function listarPorMembro(int $membroId): array
    {
        $pdo = \App\Services\Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM resenhas WHERE membro_id = :membro_id ORDER BY criada_em DESC");
        $stmt->bindValue(':membro_id', $membroId, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, self::class);
    }

    public static function listarPendentes(): array
    {
        $pdo = \App\Services\Database::getInstance();
        $stmt = $pdo->query("SELECT r.*, m.nome AS membro_nome, m.numero_processo FROM resenhas r JOIN membros m ON m.id = r.membro_id WHERE r.estado_moderacao = 'pendente' ORDER BY r.criada_em DESC");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function buscar(int $id): ?self
    {
        $pdo = \App\Services\Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM resenhas WHERE id = :id");
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetchObject(self::class);
        return $res ?: null;
    }

    public static function editarTexto(int $id, string $texto): bool
    {
        $pdo = \App\Services\Database::getInstance();
        $stmt = $pdo->prepare("UPDATE resenhas SET texto = :texto WHERE id = :id");
        $stmt->bindValue(':texto', $texto);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }

    public static function aprovar(int $id): bool
    {
        $pdo = \App\Services\Database::getInstance();
        $stmt = $pdo->prepare("UPDATE resenhas SET estado_moderacao = 'aprovada' WHERE id = :id");
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }

    public static function rejeitar(int $id): bool
    {
        $pdo = \App\Services\Database::getInstance();
        $stmt = $pdo->prepare("UPDATE resenhas SET estado_moderacao = 'rejeitada' WHERE id = :id");
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }
}
