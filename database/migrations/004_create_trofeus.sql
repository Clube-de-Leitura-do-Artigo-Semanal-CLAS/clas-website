-- Tarefa 2.7 — troféus/badges automáticos
-- PostgreSQL / Supabase

CREATE TABLE public.trofeus (
    id           INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    membro_id    INTEGER NOT NULL,
    tipo         VARCHAR(50) NOT NULL,  -- 'melhor_kwiz' | 'presenca_total_debates' | ...
    atribuido_em TIMESTAMP WITH TIME ZONE NOT NULL DEFAULT NOW(),

    CONSTRAINT trofeus_membro_fkey FOREIGN KEY (membro_id)
        REFERENCES public.membros (id) ON DELETE CASCADE
);
