-- Tarefa 2.7 — troféus/badges automáticos
CREATE TABLE trofeus (
    id INT AUTO_INCREMENT PRIMARY KEY,
    membro_id INT NOT NULL,
    tipo VARCHAR(50) NOT NULL, -- 'melhor_kwiz' | 'presenca_total_debates' | ...
    atribuido_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (membro_id) REFERENCES membros(id)
);
