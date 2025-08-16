
CREATE DATABASE IF NOT EXISTS projeto_crud CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE projeto_crud;

DROP TABLE IF EXISTS usuarios;
CREATE TABLE usuarios (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  senha VARCHAR(255) NOT NULL,
  token_recuperacao VARCHAR(255) NULL,
  data_token DATETIME NULL,
  criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  atualizado_em DATETIME NULL ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO usuarios (nome, email, senha)
VALUES ('Administrador', 'admin@exemplo.com', '$2y$10$m2gYo8j8b0H7V3X1Q6G3QujZ08G7yQWbT.2m/0o4rXwH1x2g1pR5a'); 
