<?php

class Livro
{
  public $id;
  public $titulo;
  public $autor;
  public $descricao;
}
class DB
{
  public function livros()
  {
    $db = new PDO('sqlite:database.sqlite');
    $query = $db->query("select * from livros");
    $items = $query->fetchAll();
    $retorno = [];

    foreach ($items as $item) {
      $livro = new Livro();
      $livro->id = $item['id'];
      $livro->titulo = $item['titulo'];
      $livro->autor = $item['autor'];
      $livro->descricao = $item['descricao'];
      $retorno[] = $livro;
    }

    return $retorno;
  }
}
