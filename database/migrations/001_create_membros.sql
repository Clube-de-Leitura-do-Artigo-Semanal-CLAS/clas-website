-- Tarefa 2.1 — entidade Membro
CREATE TABLE membros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero_processo VARCHAR(20) UNIQUE NOT NULL,
    qr_code VARCHAR(255) UNIQUE NOT NULL,
    estado ENUM('ativo', 'em_risco', 'inativo', 'fantasma') NOT NULL DEFAULT 'ativo',
    objetivos_entrada TEXT NULL,
    nome VARCHAR(150) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
