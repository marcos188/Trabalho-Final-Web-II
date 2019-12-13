<?php

class MyModel
{
    public function getText($message = 'Hello World!')
    {
        return $message;
    }
}


class Banco{
  private $host = "localhost";
  private $username = "root";
  private $password = "";
  private $database = "WeHatePoverty";
  private $connection = null;

  public function __construct()
  {
    $this->connect();
  }

  private function connect()
  {
  $this->connection = mysqli_connect(
                      $this->host,
                      $this->username,
                      $this->password,
                      $this->database);
  }

  public function read_fome()
  {
    $table_name = "indiceFome";
    $query = "SELECT
              *
              FROM
              ". $table_name . "
              LIMIT 1";

    $result = $this->connection->query($query);
    $request = $result->fetch_assoc();

    return $request;
  }

  public function read_pobreza()
  {
    $table_name = "indicePobreza";
    $query = "SELECT
              *
              FROM
              ". $table_name . "
              LIMIT 1";

    $result = $this->connection->query($query);
    $request = $result->fetch_assoc();

    return $request;
  }

  public function read_rendimento()
  {
    $table_name = "trabalho_rendimento";
    $query = "SELECT
              *
              FROM
              ". $table_name . "
              LIMIT 1";

    $result = $this->connection->query($query);
    $request = $result->fetch_assoc();

    return $request;
  }

  public function read_desocupacao()
  {
    $table_name = "trabalho_rendimento";
    $query = "SELECT
              *
              FROM
              ". $table_name . "
              LIMIT 1";

    $result = $this->connection->query($query);
    $request = $result->fetch_assoc();

    return $request;
  }

  public function add_answer($ansT,$val)
  {
    $table_name = "respostaUser";
    $query = "INSERT INTO ".
              $table_name .
              "(ansType,value)".
               "VALUES (". $ansT.",". $val.")";

    if (!$this->connection->query($query)){
      echo "ERROR";
    }
  }
}
