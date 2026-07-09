-- Tarefa 2.4 — roles: membro, coordenadora, rececao, admin
-- PostgreSQL / Supabase
--
-- ATENÇÃO (decisão pendente da equipa): a tabela membros (migration 001)
-- já tem uma coluna `role` do tipo role_membro. Esta tabela `roles`
-- separada é uma abordagem ALTERNATIVA (permite vários roles por membro).
-- Só uma das duas deve ficar:
--   - coluna role em membros  -> 1 role por membro (mais simples)
--   - esta tabela roles       -> vários roles por membro
-- Se ficarem com a coluna, apaguem esta migration.

CREATE TABLE public.roles (
    id            INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    utilizador_id INTEGER NOT NULL,
    nome          public.role_membro NOT NULL  -- reutiliza o tipo criado na migration 001
);
