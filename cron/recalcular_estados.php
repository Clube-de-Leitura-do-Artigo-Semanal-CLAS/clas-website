<?php

/**
 * cron/recalcular_estados.php
 *
 * Script chamado diretamente pelo crontab do servidor (não pelo browser).
 * Corre uma vez por dia. Só faz bootstrap e delega para o Job.
 *
 * Exemplo de entrada no crontab (correr às 3h da manhã):
 *   0 3 * * * php /caminho/para/clas-website/cron/recalcular_estados.php
 */

require_once __DIR__ . '/../app/bootstrap.php';

// TODO: instanciar e correr app/Jobs/RecalcularEstadosJob.php
