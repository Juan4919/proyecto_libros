SET NAMES utf8mb4;
SET CHARACTER SET utf8mb4;

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

CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

INSERT INTO usuario (email, password) VALUES ('juangm598@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

INSERT INTO genero (nombre) VALUES ('Ciencia Ficción');
INSERT INTO genero (nombre) VALUES ('Acción');
INSERT INTO genero (nombre) VALUES ('Drama');
INSERT INTO genero (nombre) VALUES ('Fantasía');
INSERT INTO genero (nombre) VALUES ('Terror');
INSERT INTO genero (nombre) VALUES ('Romance');
INSERT INTO genero (nombre) VALUES ('Thriller');
INSERT INTO genero (nombre) VALUES ('Aventura');




INSERT INTO libro (isbn, titulo, autor, editorial, genero_id) VALUES
('978-84-450-7484-0', 'Harry Potter y la piedra filosofal', 'J.K. Rowling', 'Salvat', 4),
('978-84-450-7484-1', 'El señor de los anillos: La comunidad del anillo', 'J.R.R. Tolkien', 'Minotauro', 8),
('978-84-376-0495-0', 'Cien años de soledad', 'Gabriel García Márquez', 'Real Academia Española', 3),
('978-84-204-1234-5', 'La sombra del viento', 'Carlos Ruiz Zafón', 'Planeta', 7),
('978-84-9759-456-7', 'El código Da Vinci', 'Dan Brown', 'Umbriel', 7),
('978-84-397-2100-8', 'Los juegos del hambre', 'Suzanne Collins', 'Molino', 8),
('978-84-666-5555-9', 'Crepúsculo', 'Stephenie Meyer', 'Alfaguara', 6),
('978-84-322-1234-0', 'Fahrenheit 451', 'Ray Bradbury', 'Debolsillo', 1),
('978-84-460-1111-1', '1984', 'George Orwell', 'Ediciones Destino', 1),
('978-84-206-7777-2', 'Un mundo feliz', 'Aldous Huxley', 'Alianza Editorial', 1),
('978-84-15000-01-3', 'Dune', 'Frank Herbert', 'Debolsillo', 1),
('978-84-15000-02-0', 'Neuromante', 'William Gibson', 'Minotauro', 1),
('978-84-15000-03-7', 'Fundación', 'Isaac Asimov', 'Plaza & Janés', 1),
('978-84-15000-04-4', 'El problema de los tres cuerpos', 'Liu Cixin', 'Ediciones B', 1),
('978-84-15000-05-1', 'Ready Player One', 'Ernest Cline', 'Nova', 1),
('978-84-15000-06-8', 'Jurassic Park', 'Michael Crichton', 'Plaza & Janés', 8),
('978-84-15000-07-5', 'El nombre del viento', 'Patrick Rothfuss', 'Plaza & Janés', 4),
('978-84-15000-08-2', 'Juego de tronos', 'George R.R. Martin', 'Gigamesh', 4),
('978-84-15000-09-9', 'El hobbit', 'J.R.R. Tolkien', 'Minotauro', 4),
('978-84-15000-10-5', 'Las crónicas de Narnia', 'C.S. Lewis', 'Planeta', 4),
('978-84-15000-11-2', 'La historia interminable', 'Michael Ende', 'Alfaguara', 4),
('978-84-15000-12-9', 'Mistborn: El imperio final', 'Brandon Sanderson', 'Nova', 4),
('978-84-15000-13-6', 'El marciano', 'Andy Weir', 'Ediciones B', 1),
('978-84-15000-14-3', 'El cuento de la criada', 'Margaret Atwood', 'Salamandra', 1),
('978-84-15000-15-0', 'La carretera', 'Cormac McCarthy', 'Debolsillo', 5),
('978-84-15000-16-7', 'It (Eso)', 'Stephen King', 'Plaza & Janés', 5),
('978-84-15000-17-4', 'El resplandor', 'Stephen King', 'Debolsillo', 5),
('978-84-15000-18-1', 'Drácula', 'Bram Stoker', 'Alianza Editorial', 5),
('978-84-15000-19-8', 'Frankenstein', 'Mary Shelley', 'Ediciones Cátedra', 5),
('978-84-15000-20-4', 'El exorcista', 'William Peter Blatty', 'Ediciones B', 5),
('978-84-15000-21-1', 'Orgullo y prejuicio', 'Jane Austen', 'Alba Editorial', 6),
('978-84-15000-22-8', 'Jane Eyre', 'Charlotte Brontë', 'Debolsillo', 6),
('978-84-15000-23-5', 'Cumbres borrascosas', 'Emily Brontë', 'Alianza Editorial', 6),
('978-84-15000-24-2', 'El diario de Noah', 'Nicholas Sparks', 'Roca Editorial', 6),
('978-84-15000-25-9', 'Bajo la misma estrella', 'John Green', 'Nube de Tinta', 6),
('978-84-15000-26-6', 'Eleanor & Park', 'Rainbow Rowell', 'Alfaguara', 6),
('978-84-15000-27-3', 'El amor en los tiempos del cólera', 'Gabriel García Márquez', 'Debolsillo', 6),
('978-84-15000-28-0', 'Perdida', 'Gillian Flynn', 'Planeta', 7),
('978-84-15000-29-7', 'La chica del tren', 'Paula Hawkins', 'Planeta', 7),
('978-84-15000-30-3', 'El silencio de los corderos', 'Thomas Harris', 'Ediciones B', 7),
('978-84-15000-31-0', 'Millennium: Los hombres que no amaban a las mujeres', 'Stieg Larsson', 'Destino', 7),
('978-84-15000-32-7', 'El psicoanalista', 'John Katzenbach', 'Ediciones B', 7),
('978-84-15000-33-4', 'La verdad sobre el caso Harry Quebert', 'Joël Dicker', 'Alfaguara', 7),
('978-84-15000-34-1', 'El dragón renacido', 'Robert Jordan', 'Minotauro', 4),
('978-84-15000-35-8', 'El imperio final', 'Brandon Sanderson', 'Nova', 4),
('978-84-15000-36-5', 'La quinta estación', 'N.K. Jemisin', 'Nova', 4),
('978-84-15000-37-2', 'El arco de la guadaña', 'Neal Shusterman', 'Nocturna', 1),
('978-84-15000-38-9', 'Silo', 'Hugh Howey', 'Minotauro', 1),
('978-84-15000-39-6', 'Proyecto Hail Mary', 'Andy Weir', 'Ediciones B', 1),
('978-84-15000-40-2', 'El problema final', 'Arturo Pérez-Reverte', 'Alfaguara', 8),
('978-84-15000-51-8', 'La lista de Schindler', 'Thomas Keneally', 'Alianza Editorial', 3),
('978-84-15000-52-5', 'Forrest Gump', 'Winston Groom', 'Ediciones Cátedra', 3),
('978-84-15000-53-2', 'El pianista', 'Władysław Szpilman', 'Debolsillo', 3),
('978-84-15000-54-9', 'Cadena perpetua', 'Stephen King', 'Plaza & Janés', 3),
('978-84-15000-55-6', 'Milagros inesperados', 'Stephen King', 'Debolsillo', 3),
('978-84-15000-56-3', 'El niño con el pijama de rayas', 'John Boyne', 'Salamandra', 3),
('978-84-15000-57-0', 'La vida es bella', 'Roberto Benigni', 'Alfaguara', 3),
('978-84-15000-58-7', 'Philadelphia', 'Ron Nyswaner', 'Roca Editorial', 3),
('978-84-15000-59-4', 'Un corazón invencible', 'Angelina Jolie', 'Ediciones B', 3),
('978-84-15000-60-0', 'El discurso del rey', 'David Seidler', 'Planeta', 3),
('978-84-15000-41-9', 'Misión imposible: Protocolo fantasma', 'Christopher McQuarrie', 'Planeta', 2),
('978-84-15000-42-6', 'Rápidos y furiosos: A todo gas', 'Gary Scott Thompson', 'Ediciones B', 2),
('978-84-15000-43-3', 'John Wick: El retorno', 'Derek Kolstad', 'Alfaguara', 2),
('978-84-15000-44-0', 'Duro de matar', 'Roderick Thorp', 'Debolsillo', 2),
('978-84-15000-45-7', 'Indiana Jones: En busca del arca perdida', 'George Lucas', 'Minotauro', 2),
('978-84-15000-46-4', 'Mad Max: Furia en la carretera', 'George Miller', 'Nova', 2),
('978-84-15000-47-1', 'Gladiator', 'David Franzoni', 'Plaza & Janés', 2),
('978-84-15000-48-8', 'Braveheart', 'Randall Wallace', 'Roca Editorial', 2),
('978-84-15000-49-5', 'The Dark Knight', 'Christopher Nolan', 'Salvat', 2),
('978-84-15000-50-1', 'Misión: Imposible - Nación secreta', 'Christopher McQuarrie', 'Umbriel', 2);
