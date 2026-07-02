-- Tarefa 2.4 — roles: visitante (implícito), membro, coordenadora, rececao, admin
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilizador_id INT NOT NULL,
    nome ENUM('membro', 'coordenadora', 'rececao', 'admin') NOT NULL
);
