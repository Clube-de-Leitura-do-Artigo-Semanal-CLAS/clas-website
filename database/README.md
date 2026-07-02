# database

- `migrations/` — um ficheiro por alteração à estrutura da base de dados,
  em ordem cronológica (ex: `2026_07_02_create_membros_table.sql`)
- `seeds/` — dados de exemplo para desenvolvimento local (membros fictícios,
  não usar dados reais dos 500+ membros aqui)

A tabela `membros` deve incluir, no mínimo, os campos definidos na secção 3
do documento de visão: numero_processo, qr_code, estado, objetivos_entrada,
e as relações para histórico literário (livros, eventos, troféus, badges).
