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
    public ?string $userId;      
    public string $idClas;
    public string $qrCode;
    public string $estado; 
    public ?string $objetivosEntrada;
    public string $nome;
    public string $role; 
    public string $email;
    public ?string $telefone;
    public ?string $telefoneAlternativo;
    public ?string $dataNascimento;
    public ?string $motivoEntrada;
    public ?string $comoConheceuClas;
    public ?string $dataInscricao;
    public string $criadoEm;

    public static function obterTodosPaginado(int $pagina = 1, int $porPagina = 10): array
    {
        $pdo = \App\Services\Database::getInstance();
        
        $offset = ($pagina - 1) * $porPagina;

        // Buscar total de registos para a paginação
        $stmtTotal = $pdo->query("SELECT COUNT(*) FROM membros");
        $total = (int) $stmtTotal->fetchColumn();

        $stmt = $pdo->prepare("SELECT * FROM membros ORDER BY id DESC LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', $porPagina, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();

    
        $dados = $stmt->fetchAll(\PDO::FETCH_CLASS, self::class);

        return [
            'dados' => $dados,
            'total' => $total
        ];
    }


    public static function atualizarRole(int $id, string $novaRole): bool
    {
        $pdo = \App\Services\Database::getInstance();
        $stmt = $pdo->prepare("UPDATE membros SET role = :role WHERE id = :id");
        $stmt->bindValue(':role', $novaRole);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }

    public static function obterPorUserId(string $userId): ?Membro
    {
        $pdo = \App\Services\Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM membros WHERE user_id = :user_id");
        $stmt->bindValue(':user_id', $userId);
        $stmt->execute();
        
        $membro = $stmt->fetchObject(self::class);
        return $membro ?: null;
    }

    /**
     * Busca um membro a partir do Email ou ID CLAS (usado na ativação de conta).
     */
    public static function obterPorEmailOuIdClas(string $identificador): ?Membro
    {
        $pdo = \App\Services\Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM membros WHERE email = :identificador OR id_clas = :identificador LIMIT 1");
        $stmt->bindValue(':identificador', $identificador);
        $stmt->execute();
        
        $membro = $stmt->fetchObject(self::class);
        return $membro ?: null;
    }

    /**
     * Vincula o UUID gerado pelo Supabase Auth ao perfil do membro.
     */
    public static function vincularUsuarioAuth(int $id, string $uuid): bool
    {
        $pdo = \App\Services\Database::getInstance();
        $stmt = $pdo->prepare("UPDATE membros SET user_id = :uuid WHERE id = :id");
        $stmt->bindValue(':uuid', $uuid);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }
}
