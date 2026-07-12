-- Tarefa 2.1 — entidade Membro (PostgreSQL / Supabase)
--
-- Tipos usados pela tabela. Os VALORES têm de bater com o código PHP:
--   estado_membro -> ver App\Services\EstadoMembroService (ativo/em_risco/inativo/fantasma)
--   role_membro   -> ver config/roles.php (membro/coordenadora/rececao/admin)
-- NÃO mudar estes valores sem alinhar com o código, senão o RoleMiddleware
-- e o cálculo de estado deixam de funcionar.

CREATE TYPE public.estado_membro AS ENUM ('ativo', 'em_risco', 'inativo', 'adormecido');
CREATE TYPE public.role_membro   AS ENUM ('membro', 'coordenadora', 'rececao', 'admin');

CREATE TABLE public.membros (
    id                    INTEGER GENERATED ALWAYS AS IDENTITY NOT NULL,
    user_id               UUID NULL,                                   
    numero_processo               CHARACTER VARYING(20)  NOT NULL,
    qr_code               CHARACTER VARYING(255) NOT NULL,
    estado                public.estado_membro   NOT NULL DEFAULT 'ativo'::estado_membro,
    objetivos_entrada     TEXT NULL,
    nome                  CHARACTER VARYING(150) NOT NULL,
    role                  public.role_membro     NOT NULL DEFAULT 'membro'::role_membro,
    email                 CHARACTER VARYING(150) NOT NULL,
    telefone              CHARACTER VARYING(20)  NULL,
    telefone_alternativo  CHARACTER VARYING(20)  NULL,
    data_nascimento       DATE NULL,
    motivo_entrada        TEXT NULL,
    como_conheceu_clas    TEXT NULL,
    data_inscricao        DATE NULL,
    criado_em             TIMESTAMP WITH TIME ZONE NOT NULL DEFAULT NOW(),

    CONSTRAINT membros_pkey         PRIMARY KEY (id),
    CONSTRAINT membros_email_key    UNIQUE (email),
    CONSTRAINT membros_numero_processo_key  UNIQUE (numero_processo),
    CONSTRAINT membros_qr_code_key  UNIQUE (qr_code),
    CONSTRAINT membros_user_id_key  UNIQUE (user_id),
    CONSTRAINT membros_user_id_fkey FOREIGN KEY (user_id)
        REFERENCES auth.users (id) ON DELETE CASCADE
) TABLESPACE pg_default;
