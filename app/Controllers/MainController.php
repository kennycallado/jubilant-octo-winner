<?php

namespace App\Controllers;

use App\Core\DataBase;
use App\Views\MainIndex;

use PDO;

class MainController
{
  public function index()
  {
    new MainIndex();
  }

  public function generator()
  {
    $db = new DataBase();

    /* comprobar si existe tabla posts */
    $query = "SELECT EXISTS ( SELECT FROM information_schema.tables WHERE  table_name = 't_posts');";
    $resultPosts = $db->executeSQL($query);
    /* comprobar si existe tabla comments */
    $query = "SELECT EXISTS ( SELECT FROM information_schema.tables WHERE  table_name = 't_comments');";
    $resultComments = $db->executeSQL($query);

    /* Sino existe genera lo siguiente */
    if (!$resultPosts->fetch(PDO::FETCH_ASSOC)["exists"]) {
      $sql = "CREATE TABLE IF NOT EXISTS t_posts ( post_id serial PRIMARY KEY, title VARCHAR ( 20 ), content TEXT );";
      $db->executeSQL($sql);

      /* Podría usar un faker */
      $sql = "INSERT INTO t_posts (title, content) VALUES ('Título 1', 'Contenido 1'), ('Título 2', 'Contenido 2'), ('Título 3', 'Contenido 3'), ('Título 4', 'Contenido 4');";
      $db->executeSQL($sql);
    }

    if (!$resultComments->fetch(PDO::FETCH_ASSOC)["exists"]) {
      $sql = "CREATE TABLE IF NOT EXISTS t_comments ( comment_id serial PRIMARY KEY, post_id INT, content VARCHAR ( 180 ), CONSTRAINT comment_post FOREIGN KEY (post_id) REFERENCES t_posts (post_id) ON DELETE CASCADE);";
      $db->executeSQL($sql);

      /* Podría usar un faker */
      $sql = "INSERT INTO t_comments (post_id, content) VALUES (1, 'Contenido 1'), (1, 'Contenido 2');";
      $db->executeSQL($sql);
    }
  }
}
