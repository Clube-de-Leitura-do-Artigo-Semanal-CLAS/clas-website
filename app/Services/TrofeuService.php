<?php

namespace App\Services;

/**
 * Motor de troféus/badges — Tarefa 2.7.
 *
 * O catálogo abaixo (ícones, nomes e cores) vem do trabalho do Geraldo no
 * PR #20. Os critérios de atribuição ainda estão por implementar: dependem
 * dos dados de atividade (leituras, debates, eventos), que virão do KwiZ e
 * das presenças.
 *
 * Cada regra deve ser um método próprio, para ser fácil acrescentar novas
 * sem mexer nas existentes.
 */
class TrofeuService
{
    /**
     * Catálogo de troféus disponíveis.
     * Os ícones são do Bootstrap Icons, já carregado no layout.
     */
    public const CATALOGO = [
        'melhor_kwiz' => [
            'icone' => 'bi-trophy-fill',
            'nome'  => 'Melhor Kwiz',
            'cor'   => '#F2B24C',
        ],
        'presenca_debates' => [
            'icone' => 'bi-book-fill',
            'nome'  => 'Presença nos debates',
            'cor'   => '#5B3FA8',
        ],
        'leitor_do_mes' => [
            'icone' => 'bi-star-fill',
            'nome'  => 'Leitor do Mês',
            'cor'   => '#1B6E96',
        ],
        'destaque_trimestre' => [
            'icone' => 'bi-award-fill',
            'nome'  => 'Destaque do Trimestre',
            'cor'   => '#E8456B',
        ],
        'debatedor' => [
            'icone' => 'bi-chat-quote-fill',
            'nome'  => 'Debatedor Incansável',
            'cor'   => '#2E9E6B',
        ],
        'colecionador' => [
            'icone' => 'bi-bookmark-star-fill',
            'nome'  => 'Colecionador de Livros',
            'cor'   => '#B87A00',
        ],
        'mestre_resenhas' => [
            'icone' => 'bi-mortarboard-fill',
            'nome'  => 'Mestre das Resenhas',
            'cor'   => '#7B3FA8',
        ],
        'presenca_total' => [
            'icone' => 'bi-calendar-check-fill',
            'nome'  => '100% de presença',
            'cor'   => '#1B6E96',
        ],
        'embaixador' => [
            'icone' => 'bi-people-fill',
            'nome'  => 'Embaixador do Clube',
            'cor'   => '#D94A4A',
        ],
        'leitor_diamante' => [
            'icone' => 'bi-gem',
            'nome'  => 'Leitor Diamante',
            'cor'   => '#2A7B9E',
        ],
    ];

    /** Devolve os dados de um troféu do catálogo (ícone, nome, cor). */
    public static function detalhes(string $tipo): ?array
    {
        return self::CATALOGO[$tipo] ?? null;
    }

    // --- Regras de atribuição (por implementar) -------------------------
    // Precisam dos dados de atividade, que ainda não existem na BD.
    // Ver tarefa: integração com o KwiZ e marcação de presenças.

    public function avaliarMelhorKwiz(int $membroId): void
    {
        // TODO: quando os relatórios do KwiZ chegarem (tabela kwiz_relatorios)
    }

    public function avaliarPresencaTotalDebates(int $membroId): void
    {
        // TODO: quando as presenças forem marcadas (tabela presencas)
    }
}
