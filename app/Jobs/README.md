# Jobs

Código que corre sozinho, sem um pedido HTTP a pedir — chamado pelo cron
do servidor.

- `RecalcularEstadosJob.php` (2.3)
  Corre uma vez por dia. Percorre todos os membros, chama
  EstadoMembroService para recalcular o estado de cada um com base na
  última atividade registada, e atualiza a base de dados.

  O script que o cron do servidor chama de facto está em
  `cron/recalcular_estados.php` — esse ficheiro só faz bootstrap e chama
  este Job.
