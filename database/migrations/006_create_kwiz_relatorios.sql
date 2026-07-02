-- Tarefa 2.6 — relatórios de turma recebidos via API do KwiZ
CREATE TABLE kwiz_relatorios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    membro_id INT NOT NULL,
    quiz_id VARCHAR(100) NOT NULL,
    pontuacao INT NOT NULL,
    recebido_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    payload_bruto JSON NULL, -- guarda o payload original do KwiZ para debug
    FOREIGN KEY (membro_id) REFERENCES membros(id)
);
