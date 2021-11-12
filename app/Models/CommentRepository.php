<?php

namespace App\Models;

use App\Core\Interfaces\IDataBase;
use App\Models\Comment;
use PDO;

class CommentRepository
{
  private IDataBase $db;

  function __construct(IDataBase $db)
  {
    $this->db = $db;
  }

  function checkLimit($post_id, $numRows)
  {
    /* comprueba límite de posts */
    /* en caso de superar límite */
    /* borra todos menos los últimos */
    $limit = 10;
    if ($numRows >= $limit) {
      // $query = "DELETE FROM table LIMIT 10";
      $query = "DELETE FROM t_comments WHERE ctid IN ( SELECT ctid FROM t_comments WHERE post_id = $post_id ORDER BY comment_id LIMIT 8)";
      $this->db->executeSQL($query);
    }
  }


  function getAllByPostId($post_id)
  {
    $response = [];
    $query = "SELECT * FROM t_comments WHERE post_id = $post_id;";
    $result = $this->db->executeSQL($query);

    $count = $result->rowCount();
    /* comprueba limites antes de continuar */
    $this->checkLimit($post_id, $count);

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      $comment = new Comment(...$row);
      array_push($response, $comment);
    }

    return $response;
  }

  function add($values)
  {
    $query = "INSERT INTO t_comments (post_id, content) VALUES(:post_id, :content)";
    $this->db->executeSQL($query, $values);
  }
}
