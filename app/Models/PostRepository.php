<?php

namespace App\Models;

use App\Core\Interfaces\IDataBase;
use App\Models\Post;
use PDO;

class PostRepository
{
  private IDataBase $db;
  function __construct(IDataBase $db)
  {
    $this->db = $db;
  }

  function checkLimit($numRows)
  {
    /* comprueba límite de posts */
    /* en caso de superar límite */
    /* borra todos menos los últimos */
    $limit = 50;
    if ($numRows >= $limit) {
      // $query = "DELETE FROM table LIMIT 10";
      $query = "DELETE FROM t_posts WHERE ctid IN ( SELECT ctid FROM t_posts ORDER BY post_id LIMIT 40)";
      $this->db->executeSQL($query);
    }
  }

  function getAll()
  {
    $response = [];
    $query = "SELECT * FROM t_posts;";
    $result = $this->db->executeSQL($query);

    /* comprueba limites antes de continuar */
    $this->checkLimit($result->rowCount());

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      $post = new Post(...$row);
      array_push($response, $post);
    }

    return $response;
  }

  function getOne($post_id)
  {
    $query = "SELECT * FROM t_posts WHERE post_id = $post_id;";
    $result = $this->db->executeSQL($query);

    return new Post(...$result->fetch(PDO::FETCH_ASSOC));
  }

  /* no sé si debería devolver algo*/
  function add($values)
  {
    $query = "INSERT INTO t_posts (title, content) VALUES(:title, :content)";
    $this->db->executeSQL($query, $values);
  }

  function update($values)
  {
    $query = "UPDATE t_posts SET title = :title, content = :content WHERE post_id = :post_id";
    $this->db->executeSQL($query, $values);
  }

  /* no sé si debería devolver algo*/
  function delete($post_id)
  {
    $query = "DELETE FROM t_posts WHERE post_id = $post_id;";
    $this->db->executeSQL($query);
  }
}
