<?php
/**
 * Script chamado pelo CRONTAB do servidor, 1x por dia.
 *
 * Exemplo de entrada no crontab:
 *   0 3 * * * php /caminho/para/clas-website/cron/recalcular_estados.php
 *
 * (às 3h da manhã, para não coincidir com uso normal do site)
 */

require_once __DIR__ . '/../vendor/autoload.php';

(new \App\Jobs\RecalcularEstadosJob(new \App\Services\EstadoMembroService()))->run();

echo "Estados recalculados em " . date('Y-m-d H:i:s') . PHP_EOL;
