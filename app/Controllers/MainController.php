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

    /* valida lo devuelto por la comprobación anterior */
    if (true) {
      // $sql = "DROP TABLE t_posts;";
      $sql = "CREATE TABLE IF NOT EXISTS t_posts ( post_id serial PRIMARY KEY, title VARCHAR ( 20 ), content TEXT );";
      $db->executeSQL($sql);

      $sql = "INSERT INTO t_posts (title, content) VALUES ('Título 1', 'Contenido 1'), ('Título 2', 'Contenido 2'), ('Título 3', 'Contenido 3'), ('Título 4', 'Contenido 4');";
      $db->executeSQL($sql);
    }
  }
}
