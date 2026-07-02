# Models

Um Model por tabela da base de dados. Corresponde à tarefa 2.1 (e às
entidades usadas nas tarefas seguintes da Fase 2).

Models a criar aqui:

- `Membro.php` — numero_processo, qr_code, estado, objetivos_entrada,
  histórico literário (ver campos definidos no documento de visão, secção 3)
- `Presenca.php` — presença em debates ou eventos, quem marcou, quando
- `Role.php` — visitante / membro / coordenadora / receção / admin
- `Trofeu.php` — troféus/badges atribuídos (2.7)
- `Resenha.php` — resenhas publicadas por membros (2.8)

Importante: o campo `estado` do Membro (ativo/em risco/inativo/fantasma)
NÃO deve ser calculado dentro do Model. O Model só guarda o valor atual.
Quem calcula é o Services/EstadoMembroService.php.
