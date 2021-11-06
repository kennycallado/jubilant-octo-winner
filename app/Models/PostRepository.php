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

  function getAll()
  {
    $response = [];
    $query = "SELECT * FROM t_posts;";
    $result = $this->db->executeSQL($query);

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

  function add($values)
  {
    $query = "INSERT INTO t_posts (title, content) VALUES(:title, :content)";
    $result = $this->db->executeSQL($query, $values);
  }
}
