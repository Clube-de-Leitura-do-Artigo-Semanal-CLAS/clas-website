-- Tarefa 2.8 — resenhas de livros publicadas por membros
CREATE TABLE resenhas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    membro_id INT NOT NULL,
    livro VARCHAR(200) NOT NULL,
    texto TEXT NOT NULL,
    estado_moderacao ENUM('pendente', 'aprovada', 'rejeitada') NOT NULL DEFAULT 'pendente',
    criada_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (membro_id) REFERENCES membros(id)
);
