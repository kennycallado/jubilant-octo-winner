<?php

namespace App\Views;


class PostShow
{
  public $post;
  public $comments;

  function __construct($data)
  {
    $this->post = $data["post"];
    $this->comments = $data["comments"];

    include_once "PostShow.html";
  }

  function showComments()
  {
    if (count($this->comments) > 0) {
      foreach ($this->comments as $comment) {
        echo "<tr>";
        echo "<td colspan='2'>";
        echo "$comment->content";
        echo "</td>";
        echo "</tr>";
      }
    }
  }
}
