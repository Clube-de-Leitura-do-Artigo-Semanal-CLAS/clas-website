CREATE TABLE public.membros (
    id                    INTEGER GENERATED ALWAYS AS IDENTITY NOT NULL,
    user_id               UUID NULL,                                   
    id_clas               CHARACTER VARYING(20)  NOT NULL,
    qr_code               CHARACTER VARYING(255) NOT NULL,
    estado                public.estado_membro   NOT NULL DEFAULT 'activo'::estado_membro,
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
    CONSTRAINT membros_id_clas_key  UNIQUE (id_clas),
    CONSTRAINT membros_qr_code_key  UNIQUE (qr_code),
    CONSTRAINT membros_user_id_key  UNIQUE (user_id),
    CONSTRAINT membros_user_id_fkey FOREIGN KEY (user_id)
        REFERENCES auth.users (id) ON DELETE CASCADE
) TABLESPACE pg_default;
