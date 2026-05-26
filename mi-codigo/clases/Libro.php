<?php

class Libro
{
    private $isbn;
    private $titulo;
    private $autor;
    private $editorial;
    private $genero_id;
    private $nombre_genero;

    public function __construct($isbn, $titulo, $autor, $editorial, $genero_id, $nombre_genero = '')
    {
        $this->isbn = $isbn;
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->editorial = $editorial;
        $this->genero_id = $genero_id;
        $this->nombre_genero = $nombre_genero;
    }

    public function getIsbn()
    {
        return $this->isbn;
    }
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function getAutor()
    {
        return $this->autor;
    }
    public function setAutor($autor)
    {
        $this->autor = $autor;
    }

    public function getEditorial()
    {
        return $this->editorial;
    }
    public function setEditorial($editorial)
    {
        $this->editorial = $editorial;
    }

    public function getGeneroId()
    {
        return $this->genero_id;
    }
    public function setGeneroId($genero_id)
    {
        $this->genero_id = $genero_id;
    }

    public function getNombreGenero()
    {
        return $this->nombre_genero;
    }
    public function setNombreGenero($nombre_genero)
    {
        $this->nombre_genero = $nombre_genero;
    }
}
