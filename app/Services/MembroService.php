<?php

namespace App\Services;

/**
 * Fornece os dados dos membros para a camada pública.
 *
 * Lê da tabela `membros` (Supabase/PostgreSQL).
 *
 * Se a ligação à BD falhar (ex: alguém a trabalhar offline, sem .env),
 * cai para o docs/membros.json como fallback, para o site não rebentar.
 *
 * NOTA: os campos de atividade (leituras, debates, eventos) ainda não
 * existem na tabela. Ficam a zero até virem do KwiZ e das presenças.
 * Quando existirem, basta acrescentá-los ao SELECT abaixo.
 *
 * PRIVACIDADE: a camada pública mostra apenas `nome_passe` (nome curto de
 * exibição), nunca o nome completo do membro.
 */
class MembroService
{
    private static ?array $cache = null;

    public static function todos(): array
    {
        if (self::$cache !== null) {
            return self::$cache;
        }

        $membros = self::daBaseDeDados();

        if ($membros === null) {
            // BD indisponível: usa o JSON local, se existir
            $membros = MembroExemploService::todos();
        }

        self::$cache = $membros;
        return self::$cache;
    }

    /** Procura um membro pelo número de processo (ex: CLAS0042). */
    public static function buscar(string $numeroProcesso): ?array
    {
        foreach (self::todos() as $membro) {
            if (($membro['numero_processo'] ?? null) === $numeroProcesso) {
                return $membro;
            }
        }
        return null;
    }

    /**
     * Devolve os membros da BD, ou null se a ligação falhar.
     *
     * Os campos de atividade ainda não existem na tabela — quando forem
     * criados, acrescentar ao SELECT e remover os zeros mais abaixo.
     */
    private static function daBaseDeDados(): ?array
    {
        try {
            $pdo = Database::getInstance();

            $sql = "SELECT numero_processo,
                           COALESCE(NULLIF(nome_passe, ''), nome) AS nome_passe,
                           estado
                    FROM membros
                    ORDER BY numero_processo";

            $linhas = $pdo->query($sql)->fetchAll(\PDO::FETCH_ASSOC);

            $membros = [];
            foreach ($linhas as $linha) {
                $membros[] = [
                    'numero_processo' => $linha['numero_processo'],
                    'nome_passe'      => $linha['nome_passe'],
                    'iniciais'        => self::iniciais($linha['nome_passe']),
                    'estado'          => $linha['estado'],

                    // Ainda não vêm da BD — virão do KwiZ e das presenças.
                    'leituras'        => 0,
                    'debates'         => 0,
                    'eventos'         => 0,
                    'ultimo'          => '',
                    'membro_desde'    => '',
                    'objetivo'        => '',
                    'trofeus'         => [],
                    'historico'       => [],
                    'resenhas'        => [],
                ];
            }

            return $membros;
        } catch (\Throwable $e) {
            // Sem BD (offline, .env por configurar, driver em falta) — o
            // chamador cai para o fallback do JSON.
            error_log('MembroService: BD indisponivel - ' . $e->getMessage());
            return null;
        }
    }

    /** "Ana Ferreira" -> "AF" */
    private static function iniciais(string $nome): string
    {
        $partes = array_values(array_filter(preg_split('/\s+/', trim($nome))));
        if (empty($partes)) return '?';
        $primeira = mb_substr($partes[0], 0, 1);
        $ultima = count($partes) > 1 ? mb_substr(end($partes), 0, 1) : '';
        return mb_strtoupper($primeira . $ultima);
    }
}
