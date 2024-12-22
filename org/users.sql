CREATE TABLE usuario (
    id SERIAL,
	nome varchar (255), 
	email varchar(255) NOT NULL,
	senha varchar(255) NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT TIMESTAMP,

	PRIMARY KEY (id)
);

INSERT INTO usuario (email, senha)
VALUES ('usuario@teste.com', encode(digest('senha123', 'sha256'), hex));

DELETE FROM usuario WHERE email = '...';

Senhas: senha123, teste123, segundo123, usuario123
