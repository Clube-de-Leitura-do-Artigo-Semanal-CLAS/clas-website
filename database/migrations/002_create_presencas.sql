-- Presenças em debates e eventos — alimentam o EstadoMembroService (Tarefa 2.2)
-- PostgreSQL / Supabase

CREATE TYPE public.tipo_presenca AS ENUM ('debate', 'evento');

CREATE TABLE public.presencas (
    id             INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    membro_id      INTEGER NOT NULL,
    tipo           public.tipo_presenca NOT NULL,
    data           DATE NOT NULL,
    marcado_por_id INTEGER NOT NULL,  -- utilizador com role coordenadora ou rececao
    criado_em      TIMESTAMP WITH TIME ZONE NOT NULL DEFAULT NOW(),

    CONSTRAINT presencas_membro_fkey FOREIGN KEY (membro_id)
        REFERENCES public.membros (id) ON DELETE CASCADE
);
