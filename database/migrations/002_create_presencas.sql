-- Presenças em debates e eventos — alimentam o EstadoMembroService (Tarefa 2.2)
CREATE TABLE presencas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    membro_id INT NOT NULL,
    tipo ENUM('debate', 'evento') NOT NULL,
    data DATE NOT NULL,
    marcado_por_id INT NOT NULL, -- utilizador com role coordenadora ou rececao
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (membro_id) REFERENCES membros(id)
);
