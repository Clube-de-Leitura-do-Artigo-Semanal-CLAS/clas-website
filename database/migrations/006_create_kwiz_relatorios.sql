-- Tarefa 2.6 — relatórios de turma recebidos via API do KwiZ
-- PostgreSQL / Supabase

CREATE TABLE public.kwiz_relatorios (
    id            INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    membro_id     INTEGER NOT NULL,
    quiz_id       VARCHAR(100) NOT NULL,
    pontuacao     INTEGER NOT NULL,
    recebido_em   TIMESTAMP WITH TIME ZONE NOT NULL DEFAULT NOW(),
    payload_bruto JSONB NULL,  -- payload original do KwiZ, para debug

    CONSTRAINT kwiz_relatorios_membro_fkey FOREIGN KEY (membro_id)
        REFERENCES public.membros (id) ON DELETE CASCADE
);
