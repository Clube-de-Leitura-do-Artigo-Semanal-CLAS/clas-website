-- Tarefa 2.8 — resenhas de livros publicadas por membros
-- PostgreSQL / Supabase

CREATE TYPE public.estado_moderacao AS ENUM ('pendente', 'aprovada', 'rejeitada');

CREATE TABLE public.resenhas (
    id               INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    membro_id        INTEGER NOT NULL,
    livro            VARCHAR(200) NOT NULL,
    texto            TEXT NOT NULL,
    estado_moderacao public.estado_moderacao NOT NULL DEFAULT 'pendente',
    criada_em        TIMESTAMP WITH TIME ZONE NOT NULL DEFAULT NOW(),

    CONSTRAINT resenhas_membro_fkey FOREIGN KEY (membro_id)
        REFERENCES public.membros (id) ON DELETE CASCADE
);
