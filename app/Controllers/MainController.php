<?php

namespace App\Controllers;

use App\Core\DataBase;
use PDO;

class MainController
{
  public function index()
  {
    $db = new DataBase();
    $query = "SELECT * FROM t_posts";
    $result = $db->executeSQL($query);

    echo "<pre>";
    var_dump($result->fetchAll(PDO::FETCH_ASSOC));
    // var_dump($result->fetchAll(PDO::FETCH_ASSOC));
    echo "</pre>";
  }

  public function generator()
  {
    $db = new DataBase();

    /* comprobar si existe la base de datos */
    $query = "SELECT EXISTS ( SELECT FROM information_schema.tables WHERE  table_name = 't_posts');";
    $result = $db->executeSQL($query);

    /* Sino existe genera lo siguiente */
    if (!$result->fetch(PDO::FETCH_ASSOC)["exists"]) {
      // $sql = "DROP TABLE t_posts;";
      $sql = "CREATE TABLE IF NOT EXISTS t_posts ( post_id serial PRIMARY KEY, title VARCHAR ( 20 ), content TEXT );";
      $db->executeSQL($sql);

      /* Podría usar un faker */
      $sql = "INSERT INTO t_posts (title, content) VALUES ('Título 1', 'Contenido 1'), ('Título 2', 'Contenido 2'), ('Título 3', 'Contenido 3'), ('Título 4', 'Contenido 4');";
      $db->executeSQL($sql);
    }
  }
}
