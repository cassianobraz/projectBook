<?php
class DB
{
  private $db;

  public function __construct($config)
  {
    $this->db = new PDO($this->getDns($config));
  }

  private function getDns($config)
  {
    $driver = $config['driver'];
    unset($config['driver']);

    $dns = $driver . ':' . http_build_query($config, '', ';');

    if ($driver == 'sqlite') {
      $dns = $driver . ':' . $config['database'];
    }

    return $dns;
  }

  public function query($query, $class = null, $params = [])
  {
    $prepare = $this->db->prepare($query);

    if ($class) {
      $prepare->setFetchMode(PDO::FETCH_CLASS, $class);
    }
    $prepare->execute($params);

    return $prepare;
  }
}

$database = new DB($config['database']);
