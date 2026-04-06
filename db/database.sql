CREATE DATABASE IF NOT EXISTS libreria_bd;
USE libreria_bd;

DROP TABLE IF EXISTS libro;
DROP TABLE IF EXISTS genero;

CREATE TABLE genero (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE libro (
    isbn VARCHAR(20) PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    autor VARCHAR(100) NOT NULL,
    editorial VARCHAR(100) NOT NULL,
    genero_id INT NOT NULL,
    FOREIGN KEY (genero_id) REFERENCES genero(id)
) ENGINE=InnoDB;

INSERT INTO genero (nombre) VALUES ('Ciencia Ficción');
INSERT INTO genero (nombre) VALUES ('Acción');
INSERT INTO genero (nombre) VALUES ('Drama');
INSERT INTO genero (nombre) VALUES ('Fantasía');
INSERT INTO genero (nombre) VALUES ('Terror');
INSERT INTO genero (nombre) VALUES ('Romance');
INSERT INTO genero (nombre) VALUES ('Thriller');
INSERT INTO genero (nombre) VALUES ('Aventura');




INSERT INTO libro (isbn, titulo, autor, editorial, genero_id)
VALUES ('978-84-450-7484-0', 'Harry Potter', 'J.K. Rowling', 
'Salvat', 4), ('978-84-450-7484-1', 'El señor de los anillos', 
'J.R.R Tolkien', 'Minotauro Ediciones', 8);